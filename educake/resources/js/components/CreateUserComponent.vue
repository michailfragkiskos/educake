<template>
        <div class="my-5 row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create new User</div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" v-model="user.name"
                                   aria-describedby="nameHelp" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" v-model="user.email"
                                   aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1"
                                   v-model="user.password"
                                   placeholder="Password">
                        </div>

                        <button type="button" @click="createUser" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>

</template>

<script>
    export default {
          data() {
        return {
            user: {
                name: '',
                email: '',
                password:''
            }
          }
        },
        methods: {
           createUser: function () {
                var url = '/api/users';
                var that=this;
                axios.post(url, this.user).then(response => {
                    that.$parent.getUsers();
                }).catch(function (error) {
                }).finally(function () {
                    that.$parent.getUsers();
                });
            }
        }
    }
</script>
