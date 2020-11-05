<template>
        <div class="my-5 row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Update User </div>

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
                        <button type="button" @click="updateUser" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>

</template>

<script>
    export default {
        props:['user'],
        methods:{
            updateUser:function(){
                var url='/api/users/'+this.user.id;
                var that = this;
                axios.put(url, this.user).then(response => {
                    that.$parent.getUsers();
                }).catch(function (error){
                }).finally(function(){
                    that.$parent.getUsers();
                });
            }
        }
    }
</script>
