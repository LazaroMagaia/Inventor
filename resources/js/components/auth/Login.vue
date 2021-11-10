<template>
    <div>
        <!-- Login Content -->
        <div class="container-login">
            <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="login-form">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Login</h1>
                        </div>
                        <form class="user" @submit.prevent="login">
                            <div class="form-group">
                            <input type="email" class="form-control" id="exampleInputEmail"
                            v-model="form.email" aria-describedby="emailHelp"
                            placeholder="Enter Email Address">
                            <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small>
                            </div><!--email-->

                            <div class="form-group">
                            <input type="password" class="form-control" id="exampleInputPassword"
                            placeholder="Password" v-model="form.password">
                            <small class="text-danger" v-if="errors.password">{{errors.password[0]}}</small>
                            </div><!--password-->

                            <div class="form-group">
                            <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                <label class="custom-control-label" for="customCheck">Remember
                                Me</label>
                            </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                            </div>
                        </form>
                        <hr>
                        <div class="text-center">
                            <router-link to="/register" class="font-weight-bold small" >
                            Create an Account!
                            </router-link>
                        </div><!--Create an Account!-->
                        <div class="text-center">
                            <router-link to="/forgot" class="font-weight-bold small" >forgot password</router-link>
                        </div><!--forgot password-->
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <!-- Login Content -->
    </div>
</template>
<script>
export default {
    created(){
        if(User.loggedIn())
        {
            this.$router.push({name: 'home'})
        }
    },
    data(){
        return{
            form:{
                email:'',
                password:''
            },
            errors:{}
        }
    },
    methods:{
        async login(){
        await axios.post('/api/auth/login',this.form)
            .then(res =>{
                 this.$router.push({name: 'home'});
                    Toast.fire({
                    icon: 'success',
                    title: 'Signed in successfully'
                })
                User.responseAfterLogin(res);
            })
            .catch(error =>this.errors= error.response.data.errors)
            .catch(
                Toast.fire({
                icon: 'warning',
                title: 'Invalid email or password'
            }))
        }
    }
}
</script>
