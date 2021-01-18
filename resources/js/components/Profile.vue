<style>

.widget-user-header
{
    background-position: center center;
    background-size: cover;

    height: 200px !important;

}

</style>


<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-5">
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white" style="background-image:url('./img/bg.jpg')">
                <h3  class="widget-user-username text-left p-4"  >{{form.name}}</h3>
                <h5 class="widget-user-desc text-left px-4 py-2">{{form.type}}</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" :src="getProfilePhoto()" alt="User Avatar">
              </div>
              <div class="card-footer p-4">
                <div class="row">
                  <div class="col-sm-12 ">
                    <div class="description-block">
                      <h5 class="description-header">{{form.description}}</h5>
                      
                    </div>
                    <!-- /.description-block -->
                  </div>
                 
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>




            <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                
                                <li class="nav-item"><a class="nav-link active show" href="#settings" data-toggle="tab">Settings</a></li>
                                <li class="nav-item"><a class="nav-link" href="#change-password" data-toggle="tab">Change Password</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                              
                                <!-- Setting Tab -->
                                <div class="tab-pane active show" id="settings">
                                    <form  class="form-horizontal">
                                        <div class="form-group">
                                            <label for="inputName" class="col-sm-2 control-label">Name</label>

                                            <div class="col-sm-12">
                                            <input type="" v-model="form.name" class="form-control" id="inputName" placeholder="Name" :class="{ 'is-invalid': form.errors.has('name') }">
                                            <has-error :form="form" field="name"></has-error>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                            <div class="col-sm-12">
                                                <input type="email" v-model="form.email" class="form-control" id="inputEmail" placeholder="Email"  :class="{ 'is-invalid': form.errors.has('email') }">
                                                <has-error :form="form" field="email"></has-error>
                                            </div>
                                        </div>

                                       <div class="form-group">
                                    <label for="photo" class="col-sm-2 control-label">Profile Photo</label>
                                    <div class="col-sm-12">
                                        <input type="file" @change="updateProfile" name="photo" class="form-input">
                                    </div>

                                </div>

                                        <div class="form-group">
                                            <label for="inputEmail" class="col-sm-2 control-label">Self Description</label>

                                            <div class="col-sm-12">
                                                <textarea  v-model="form.description" class="form-control" id="description" placeholder="Description"  :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                                                <has-error :form="form" field="description"></has-error>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <button type="submit" @click.prevent="updateInfo" class="btn btn-success">Update Profile</button>
                                                <div class="float-right d-sm-inline text-muted">Member since: <span>{{form.created_at|myDate}}</span></div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Setting Tab -->
                                <div class="tab-pane" id="change-password">
                                    <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="current_password" class="col-sm-2 control-label">Current Password</label>

                                        <div class="col-sm-12">
                                            <input type="password"
                                                v-model="form.current_password"
                                                class="form-control"
                                                id="current_password"
                                                placeholder="Current Password"
                                                :class="{ 'is-invalid': form.errors.has('current_password') }"
                                            >
                                            <has-error :form="form" field="current_password"></has-error>
                                        
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password" class="col-sm-2 control-label">New Password</label>

                                        <div class="col-sm-12">
                                            <input type="password"
                                                v-model="form.new_password"
                                                class="form-control"
                                                id="new_password"
                                                placeholder="New Password"
                                                :class="{ 'is-invalid': form.errors.has('new_password') }"
                                            >
                                            <has-error :form="form" field="new_password"></has-error>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="confirm_password" class="col-sm-2 control-label">Confirm Password</label>

                                        <div class="col-sm-12">
                                            <input type="password"
                                                v-model="form.confirm_password"
                                                class="form-control"
                                                id="confirm_password"
                                                placeholder="Confirm Password"
                                                :class="{ 'is-invalid': form.errors.has('confirm_password') }"
                                            >
                                            <has-error :form="form" field="confirm_password"></has-error>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-12">
                                        <button @click.prevent="updatePassword" type="submit" class="btn btn-success">Update Password</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>



            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {

                 
                 form: new Form({
                    id:'',
                    name : '',
                    type : '',
                    email: '',
                    password: '',
                    photo: '',
                    description : '',
                    created_at: ''
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{

            /* getProfilePhoto(){
                let photo = (this.form.photo.length > 200) ? this.form.photo : "img/profile/"+ this.form.photo ;
                return photo;
            }, */

           /*  getProfilePhoto() {
            let prefix = (this.form.photo.match(/\//) ? '' : '/img/profile/');
            return prefix + this.form.photo;
            }, */
            getProfilePhoto(){
                //default avatar pic if there is no photo of user
                let photo = "img/user.png";
                //returns the current path of the
                if (this.form.photo) {
                    photo = (this.form.photo.indexOf('base64') != -1 ? this.form.photo : 'img/profile/'+ this.form.photo);
                return photo;
                }
                return photo;
            },



            updateInfo(){
                this.$Progress.start();
                
                this.form.put('api/profile')
                .then(()=>{

                    //this.loadUserData();
                    Fire.$emit('AfterCreate');
                    this.$Progress.finish();
                    Toast.fire({
                        icon: 'success',
                        title: 'Profile has been updated'
                    });

                      
                })
                .catch((data) => {
                    this.$Progress.fail();

                    Toast.fire({
                        icon: 'error',
                        title: 'Some error occured! Please try again'
                    });
                });
            },

            updatePassword(){
                this.$Progress.start();
                this.form.post('api/change-password')
                .then((data)=>{
                    //  Fire.$emit('AfterCreate');
                    this.$Progress.finish();
                    this.form.current_password = '';
                    this.form.new_password = '';
                    this.form.confirm_password = '';

                    Toast.fire({
                        icon: 'success',
                        title: data.data.message
                    });
                })
                .catch(() => {
                    this.$Progress.fail();

                    Toast.fire({
                        icon: 'error',
                        title: 'Some error occured! Please try again'
                    });
                });
            },
            loadUserData()
                {

                    

                axios.get("api/profile").then(({ data }) => (this.form.fill(data.data)));
            
                }
                ,

 
                updateProfile(e){
                let file = e.target.files[0];
                let reader = new FileReader();
                let limit = 1024 * 1024 * 2;
                if(file['size'] > limit){
                    Toast.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'You are uploading a large file',
                    })
                    return false;
                }
                reader.onloadend = (file) => {
                    this.form.photo = reader.result;
                }
                reader.readAsDataURL(file);
            }


        },


        

        created() {

            this.$Progress.start();

            this.loadUserData();

            this.$Progress.finish();
        }
    }
</script>
