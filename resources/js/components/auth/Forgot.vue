<template>
    <div>
         <!-- Forget Content -->
        <div class="container-login">
            <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="login-form">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Forget Password</h1>
                        </div>
                        <form>
                            <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail"
                            aria-describedby="emailHelp"
                                placeholder="Enter Existing Email Address">
                            </div>
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Send</button>
                            </div>
                        </form>
                        <hr>
                        <div class="text-center">
                            <router-link to="/" class="font-weight-bold small" >back to login</router-link>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <!-- Forget Content -->
    </div>
</template>

<script>
export default {
    data(){
        return{

        }
    }
}
</script>
