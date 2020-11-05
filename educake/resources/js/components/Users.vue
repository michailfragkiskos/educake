<template>
<div>
    <h2>Users Listing</h2>
    <button @click="createUser= !createUser" class="btn btn-success mb-2">Add New User</button>
    <CreateUser-component v-if="createUser"></CreateUser-component>

    <UpdateUser-component v-if="updateUser" :user="user"></UpdateUser-component>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="user in users" :key="user.id">
            <td>{{user.id}}</td>
            <td>{{user.name}}</td>
            <td>{{user.email}}</td>
            <td>{{user.created}}</td>
            <td>
                <button @click.prevent="editUser(user)" class="btn btn-primary">Edit</button>
                <button  @click.prevent="deleteUser(user.id)" class="btn btn-danger">Delete</button>
            </td>
        </tr>

        </tbody>
    </table>
</div>
</template>

<script>
export default {
    data(){
        return {
            createUser:false,
            updateUser:false,
            users:[],
            user:{
                id:0,
                name:'',
                email:''
            }
        }
    }, methods: {
        getUsers() {
            this.createUser =false;
            this.updateUser =false;
            var that = this;
            axios.get('/api/users')
                .then(response => {
                    that.users = response.data;
                });
        },
        editUser:function (user){
            this.user=user;
            this.updateUser = !this.updateUser;
        },
        deleteUser:function (id){
            var url = '/api/users/'+id;
            var that = this;
            axios.delete(url)
                .then(response => {
                    that.getUsers();
                });
        }
    },
mounted() {
    this.getUsers();
}


}

</script>

