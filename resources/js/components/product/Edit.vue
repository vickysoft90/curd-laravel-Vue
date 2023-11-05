<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Product</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="update">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" v-model="product.name">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="text" class="form-control" v-model="product.amount">
                                </div>
                            </div>
                             <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Qty</label>
                                    <input type="text" class="form-control" v-model="product.qty">
                                </div>
                            </div>
                            
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select placeholder="choose" Required class="form-control" v-model="product.category_id" name="category_id" >
                                       <option class="rounded-full" disabled value>Choose</option>
                                        <option
                                            v-for="(cat,index) in categories"
                                            :key="index"
                                            :value=cat.id
                                             v-bind:value="cat.id"
                                             >
                                            {{ cat.title }}
                                        </option>
                                    </select>
                                    
                                </div>
                            </div>

                            <div class="col-12 mb-2">
                                <div class="form-group">
                                <label>Select tags</label>
                                    <div  v-for="(item, index) in tags" :key="index">
                                    <input type="checkbox" :id="item.title" v-model="item.checked" >
                                    <label :for="item.id">{{ item.title }}</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 mb-2">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
let tag_ids;
export default{
    name:"update-product",
    data(){
        return{
            product:{
                name:"",
                amount:"",
                qty:"",
                category_id:"",
                _method:"patch"
            },
            categories:[],
            tags:[]
        }
    },
    computed: {
        checkedNames () {
            return this.tags.filter(item => item.checked).map(item => item.id)
        }
    },
    mounted(){
        this.showProduct(),
        this.getCategories()
        this.getTag()
    },
    methods:{
        
  
        async showProduct(){
            await this.axios.get('/api/product/'+this.$route.params.id).then(response=>{
                const { name, amount, qty, category_id, tag_id} = response.data
                this.product.name = name
                this.product.amount = amount
                this.product.qty = qty
                this.product.category_id = category_id
                this.product.tag_id = tag_id
                
            }).catch(error=>{
                console.log(error)
            })
        },
         async getTag(){
            await this.axios.get('/api/tag').then(response=>{
                this.tag_ids = response.data;
                if(this.product.tag_id!=null  && this.product.tag_id!="undefined"){
                let tagArray = this.product.tag_id.split(",");
                for (let i = 0; i < this.tag_ids.length; i++) {
                        for (let j = 0; j < tagArray.length; j++) {
                                    if (tagArray[j]==this.tag_ids[i].id) {
                                        this.tag_ids[i].checked = true;
                                    } 
                        }
                    }
                this.tags=this.tag_ids;
                }else{                   
                this.tags=response.data;
                
                }
            }).catch(error=>{
                console.log(error)
                this.tags = []
            })
        },
        async getCategories(){
            await this.axios.get('/api/category').then(response=>{
                this.categories = response.data
            }).catch(error=>{
                console.log(error)
                this.categories = []
            })
        },
        async update(){
        this.product.tag_id=this.checkedNames.toString();
            await this.axios.post('/api/product/'+this.$route.params.id, this.product).then(response=>{
                this.$router.push({name:"productList"})
            }).catch(error=>{
                console.log(error)
            })
        },
        
    }
}
</script>