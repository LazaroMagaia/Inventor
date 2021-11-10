<template>
    <div>
           <router-link to="/employee" class="btn btn-primary">All Employees</router-link>
         <!-- Register Content -->
        <div class="container-login">
            <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="login-form">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Employee Update</h1>
                        </div>
                        <form @submit.prevent="employeeUpdate" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6 p-2">
                                        <label>Name</label>
                                        <input type="text" class="form-control" id="exampleInputFirstName"
                                        placeholder="Enter full Name" v-model="form.name">
                                        <small class="text-danger" v-if="errors.name">
                                            {{errors.name[0]}}
                                        </small>
                                    </div><!--col-md-6-->

                                     <div class="col-md-6 p-2">
                                        <label>Email</label>
                                        <input type="email" class="form-control" id="exampleInputEmail"
                                        aria-describedby="emailHelp" placeholder="Enter Email Address"
                                        v-model="form.email">
                                        <small class="text-danger" v-if="errors.email">
                                            {{errors.email[0]}}
                                        </small>
                                    </div><!--col-md-6-->

                                    <div class="col-md-6 p-2">
                                        <label>Address</label>
                                        <input type="text" class="form-control" id="exampleInputAddress"
                                        aria-describedby="textHelp" placeholder="Enter Your Address"
                                        v-model="form.address">
                                        <small class="text-danger" v-if="errors.address">
                                            {{errors.address[0]}}
                                        </small>
                                    </div><!--col-md-6-->

                                    <div class="col-md-6 p-2">
                                        <label>Your Sallery</label>
                                        <input type="text" class="form-control" id="exampleInputSallery"
                                        aria-describedby="textHelp" placeholder="Enter Your Sallery"
                                        v-model="form.sallery">
                                        <small class="text-danger" v-if="errors.sallery">
                                            {{errors.sallery[0]}}
                                        </small>
                                    </div><!--col-md-6-->

                                    <div class="col-md-6 p-2">
                                        <label>Join Date</label>
                                        <input type="date" class="form-control" id="exampleInputDate"
                                        aria-describedby="textHelp" placeholder="Join Date"
                                        v-model="form.join_date">
                                        <small class="text-danger" v-if="errors.join_date">
                                            {{errors.join_date[0]}}
                                        </small>
                                    </div><!--col-md-6-->

                                    <div class="col-md-6 p-2">
                                        <label>Your Nuit</label>
                                        <input type="text" class="form-control" id="exampleInputNuit"
                                        aria-describedby="textHelp" placeholder="Enter Your Nuit"
                                        v-model="form.nuit">
                                        <small class="text-danger" v-if="errors.nuit">
                                            {{errors.nuit[0]}}
                                        </small>
                                    </div><!--col-md-6-->

                                </div><!--form-row-->
                            </div><!--form-group-->

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label>Phone number</label>
                                        <input type="text" class="form-control" id="exampleInputNumber"
                                        aria-describedby="textHelp" placeholder="Enter Your Phone Number"
                                        v-model="form.phone">
                                        <small class="text-danger" v-if="errors.phone">
                                            {{errors.phone[0]}}
                                        </small>
                                    </div><!--col-md-6-->

                                </div><!--form-row-->
                            </div><!--form-group-->
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label>Photo</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile"
                                            @change="onFileSelected">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        <small class="text-danger" v-if="errors.photo">
                                            {{errors.photo[0]}}
                                        </small>
                                    </div><!--col-md-6-->

                                    <div class="col-md-6">
                                        <img :src="form.photo" style="height:80px; width:80px; object-fit:cover;">
                                    </div><!--col-md-6-->

                                </div>
                            </div>

                            <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                            </div>
                        </form>
                        <hr>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <!-- Register Content -->
    </div>
</template>
<script>

export default {
    data(){
        return{
            form:{
                name:'',
                email:'',
                address:'',
                sallery:'',
                nuit:'',
                phone:'',
                photo:'',
                newphoto:'',
                join_date:'',
            },
            errors:{}
        }
    },
    methods:{
        onFileSelected(event){
            let file = event.target.files[0];
            if(file.size > 1048770){
                Notification.image_Validation()
            }else
            {
                let reader = new FileReader();
                reader.onload = event =>{
                    this.form.photo = this.form.newphoto = event.target.result
                    console.log(event.target.result)
                };
                reader.readAsDataURL(file);
            }
        },
        employeeUpdate(){
            let id = this.$route.params.id;
            axios.put('/api/employee/'+id,this.form)
            .then(()=>{
                this.$router.push({name:'employee'})
                Notification.success();
            }).catch(error => this.errors = error.response.data.errors)
        }
    },
    created(){
        let id = this.$route.params.id;
        axios.get('/api/employee/'+id)
        .then(({data}) => (this.form = data))
        .catch(console.log('error'))
    },
}
</script>
