<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Laravel Vue Datatables Component Example - Tutsmake.com</div>
   
                    <div class="card-body">
                       
   
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
   
<script>
   
   
    export default {
       
        mounted() {
            console.log('Component mounted.')
        },
        data(){
            return {
                columns: [
                        {label: 'id', field: 'id'}, 
                        {label: 'Title', field: 'title'},
                        {label: 'Description', field: 'description'}
                    ],
                rows: [],
                page: 1,
                per_page: 10,
            }
        },
        methods:{
            getPosts: function() {
                axios.get('/posts').then(function(response){
                    this.rows = response.data;
                }.bind(this));
            }
        },
        created: function(){
            this.getPosts()
        }
    }
</script>