<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Tag</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="update">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" v-model="tag.title">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" class="form-control" v-model="tag.description">
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
export default{
    name:"update-Tag",
    data(){
        return{
            tag:{
                title:"",
                description:"",
                _method:"patch"
            }
        }
    },
    mounted(){
        this.showTag()
    },
    methods:{
        async showTag(){
            await this.axios.get('/api/tag/'+this.$route.params.id).then(response=>{
                const { title, description} = response.data
                this.tag.title = title
                this.tag.description = description
            }).catch(error=>{
                console.log(error)
            })
        },
        async update(){
            await this.axios.post('/api/tag/'+this.$route.params.id, this.tag).then(response=>{
                this.$router.push({name:"tagList"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>