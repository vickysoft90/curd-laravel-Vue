<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"tagAdd"}' class="btn btn-primary">Create</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tag</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody v-if="tags.length > 0">
                                <tr v-for="(tag,key) in tags" :key="key">
                                    <td>{{ tag.id }}</td>
                                    <td>{{ tag.title }}</td>
                                    <td>{{ tag.description }}</td>
                                    <td>
                                        <router-link :to='{ name:"tagEdit" , params:{ id:tag.id } }' class="btn btn-success">Edit</router-link>
                                        <button type="button" @click="deleteTag(tag.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="4" align="center">No Tags Found.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                      
                    
                </div>
              
            </div>
        </div>
    </div>
</template>

<script>


export default {
    name:"tags",
    data(){
        return{
            tags:[]
        }
    },
    mounted(){
        this.getTag()
    },
    methods:{
        async getTag(){
            await this.axios.get('/api/tag').then(response=>{
                this.tags = response.data
            }).catch(error=>{
                console.log(error)
                this.tags = []
            })
        },
        deleteTag(id){
            if(confirm("Are you sure to delete this tag ?")){
                this.axios.delete('/api/tag/'+id).then(response=>{
                    this.getTag()
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    }
}
</script>