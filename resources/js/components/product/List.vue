<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"productAdd"}' class="btn btn-primary">Create</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Product</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                    <th>Category</th>
                                    <th>Tags</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody v-if="products.length > 0">
                                <tr v-for="(product,key) in products" :key="key">
                                    <td>{{ product.id }}</td>
                                    <td>{{ product.name }}</td>
                                    <td>{{ product.qty }}</td>
                                    <td>{{ product.amount }}</td>
                                    <td>{{ product.title }}</td>
                                     <td>{{ product.tag_name }}</td>
                                    <td>
                                        <router-link :to='{ name:"productEdit" , params:{ id:product.id } }' class="btn btn-success">Edit</router-link>
                                        <button type="button" @click="deleteProduct(product.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="4" align="center">No Product Found.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div  style="float:left">
                        <button type="button" disabled class="btn btn-info btn-sm">PAGE SIZE : 5</button>
                    </div>
                   <div  style="float:right">
                        <button type="button" @click="previous()" class="btn btn-primary btn-sm">Previous</button>
                        <button type="button" @click="moveNext()" class="btn btn-secondary btn-sm">Next</button>
                    </div>
                </div>
              
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name:"products",
    data(){
        return{
            products:[],
            page: 0
        }
    },
    mounted(){
        this.getProduct(this.page)
    },
    methods:{
        async getProduct(page=0){
            await this.axios.get('/api/product?page=' + page).then(response=>{
                this.products = response.data
                if(response.data.length<=0){
                //this.page=parseInt(this.page);
                }
            }).catch(error=>{
                console.log(error)
                this.tags = []
            })
        },
        deleteProduct(id){
            if(confirm("Are you sure to delete this product ?")){
                this.axios.delete('/api/product/'+id).then(response=>{
                    this.getProduct()
                }).catch(error=>{
                    console.log(error)
                })
            }
        },
        moveNext(){
            this.page=parseInt(this.page)+1;
            this.getProduct(this.page);
            },
        previous(){
                if(this.page<=0){
                this.page=0;
                }
                else{
                    this.page=parseInt(this.page)-1;
                    this.getProduct(this.page);
                }
            }
    }
    
}
</script>