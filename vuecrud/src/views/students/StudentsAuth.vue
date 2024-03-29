<template>
    <div class="mb-3">
                   <button @click="register" class="btn btn-primary">register</button>
                </div>
                <div class="mb-3">
                   <button @click="login" class="btn btn-primary">login</button>
                </div>
                <div class="mb-3">
                   <button @click="getUser" class="btn btn-danger">all students</button>
                </div>
</template>




<script>
import axios from '@/axios';


export default{
    name:'registersAuth',
    data(){
        return {
            errorList:'',
            model:{
                register : {
                    name: 'lllll',
                   
                    email: 'admin@gmail.com',
                    password: '123456789',
                    password_confirmation: '123456789',
                },
                login : {
                    email: 'admin@gmail.com',
                    password: '123456789',
                }
            },
            accessToken:"",
        }
    },
    methods:{
    register(){
            var mythis = this;
            axios.post('http://localhost:8000/api/register',this.model.register).then(res=>{
                console.log(res.data);
               
                this.model.register={
                    name:'',
                   
                    email:'',
                    password:'',
                }
                this.errorList = '';
            }).catch(function (error) {
                if (error.response) {
                    if(error.response.status = 422){
                        mythis.errorList = error.response.data.errors;
                    }

                console.log(error.response.data);
                console.log(error.response.status);
                console.log(error.response.headers);
                } else if (error.request) {
      
                    console.log(error.request);
    } else {
      
      console.log('Error', error.message);
    }
            });
        },


      login(){
            var mythis = this;
            console.log(this);
            console.log(mythis);
            axios.post('/login',this.model.login).then(res=>{
                localStorage.setItem('token', res.data.token);
                console.log(res.data.token);
                this.accessToken = res.data.token;
                console.log('mon totken est le : ' + this.accessToken);
               
                this.model.login={
                   
                    email:'',
                    password:'',
                }
                this.errorList = '';
            }).catch(function (error) {
                if (error.response) {
                    if(error.response.status = 422){
                        mythis.errorList = error.response.data.errors;
                    }

                console.log(error.response.data);
                console.log(error.response.status);
                console.log(error.response.headers);
                } else if (error.request) {
      
                    console.log(error.request);
    } else {
      
      console.log('Error', error.message);
    }
            });
        },

       getUser(){
            
            axios.get('/students',{
                headers: {
        Authorization: `Bearer ${localStorage.getItem('token')}`
      }
            }).then(res=>{
                    console.log(res.data);
            }).catch(function (error) {
                if (error.response) {
                    if(error.response.status = 422){
                        mythis.errorList = error.response.data.errors;
                    }

                console.log(error.response.data);
                console.log(error.response.status);
                console.log(error.response.headers);
                } else if (error.request) {
      
                    console.log(error.request);
    } else {
      
      console.log('Error', error.message);
    }
            });
        }
    }
}



</script>