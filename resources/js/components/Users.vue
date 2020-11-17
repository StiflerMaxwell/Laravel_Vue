<template>
    <div class="container">
         <div class="row mt-5">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-sm btn-primary" @click="newModal" data-toggle="modal" data-target="#userModal"  >
                      <i class="fa fa-plus-square"></i>
                      Add New
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Type</th>
                      <th>Created at</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="user in users" :key ="user.id">
                      <td class="text-capitalize">{{user.id}}</td>
                      <td class="text-capitalize">{{user.name}}</td>
                      <td>{{user.email}}</td>
                      <td>{{user.type}}</td>
                      <td>{{user.created_at | myDate}}</td>
                      <td> 
                       <a href="#"  @click="editModal(user)" >
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#" @click="deleteUser(user.id)">
                            <i class="fa fa-trash red"></i>
                        </a>
                      </td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>


        
        <!-- creat user form -->
        <form @submit.prevent="editmode ? updateUser() : createUser()">
        <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" v-show="!editmode">Create New User</h5>
                    <h5 class="modal-title" v-show="editmode">Update User's Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
            <label>Name</label>
            <input v-model="form.name" type="text" name="name"
                class="form-control" placeholder="Name" :class="{ 'is-invalid': form.errors.has('name') }">
            <has-error :form="form" field="name"></has-error>
            </div>

            <div class="form-group">
            <label>Email</label>
            <input v-model="form.email" type="text" name="email"
                class="form-control" placeholder="Email" :class="{ 'is-invalid': form.errors.has('email') }">
            <has-error :form="form" field="email"></has-error>
            </div>

            <div class="form-group">
            <label>Password</label>
            <input v-model="form.password" type="password" name="password"
                class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
            <has-error :form="form" field="password"></has-error>
            </div>


           <div class="form-group">
                <label>User Type</label>
                <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                    <option value="">Select User Role</option>
                    <option value="Admin">Admin</option>
                    <option value="User">Standard User</option>
                </select>
                <has-error :form="form" field="type"></has-error>
            </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                
                <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
            </div>
            </div>
        </div>
        </div>
        </form>



    </div>



    
</template>

<script>
    export default {
       data () {
    return {
        editmode: false,
        users :{},

      // Create a new form instance
      form: new Form({
          id : '',
        name: '',
        email: '',
        password: '',
        type: ''
         
      })
    }
       },
        
        
        
        methods:{


            loadUsers()
            {


                axios.get("api/users").then(({ data }) => (this.users = data.data));


            },


            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#userModal').modal('show');
            },

             editModal(user){
                this.editmode = true;
                this.form.reset();
                $('#userModal').modal('show');
                this.form.fill(user);
            },


            createUser(){


                    this.$Progress.start();                   
                    this.form.post('api/users')
                     .then((response)=>{

                  $('#userModal').modal('hide');

                  Toast.fire({
                        icon: 'success',
                        title: response.data.message
                  });

                  this.$Progress.finish();
                  this.loadUsers();

              })
              .catch(()=>{

                  Toast.fire({
                      icon: 'error',
                      title: 'Some error occured! Please try again'
                  });
                  this.$Progress.fail();
              })
                    

            },

  
            updateUser(){
                this.$Progress.start();
                  console.log('Editing data');
                this.form.put('api/users/'+this.form.id)
                .then((response) => {
                    // success
                    $('#userModal').modal('hide');
                    Toast.fire({
                      icon: 'success',
                      title: response.data.message
                    });
                    this.$Progress.finish();
                        //  Fire.$emit('AfterCreate');

                    this.loadUsers();
                })
                .catch(() => {
                    Toast.fire({
                      icon: 'error',
                      title: 'Some error occured! Please try again'
                  });

                    this.$Progress.fail();
                });

            },


            deleteUser(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {

                        // Send request to the server
                         if (result.value) {
                                this.form.delete('api/users/'+id).then(()=>{
                                        Swal.fire(
                                        'Deleted!',
                                        'User has been deleted.',
                                        'success'
                                        );
                                      //Fire.$emit('AfterCreate');
                                    this.loadUsers();
                                }).catch((data)=> {
                                  Swal.fire("Failed!", data.message, "warning");
                              });
                         }
                    })
            }




 


        },
 
        created() {

            this.$Progress.start()
            this.loadUsers();
            this.$Progress.finish();
            console.log('Component mounted.')
        }
    }
</script>
