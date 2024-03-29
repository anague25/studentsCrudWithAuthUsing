<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Add Students</h4>
            </div>
            <div class="card-body">

                <ul class="alert alert-warning" v-if="Object.keys(this.errorList).length > 0">
                <li class="ms-3 mb-0" v-for="(error,index) in this.errorList" :key="index">
                    {{ error[0] }}

                </li>
            </ul>

                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" v-model="model.student.name" id="name" class="form-control"/>
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="text" v-model="model.student.email" id="email" class="form-control"/>
                </div>
                <div class="mb-3">
                    <label for="courses">Course</label>
                    <input type="text" v-model="model.student.courses" id="courses" class="form-control"/>
                </div>
                <div class="mb-3">
                    <label for="phone">Phone</label>
                    <input type="text" v-model="model.student.phone" id="phone" class="form-control"/>
                </div>
                <div class="mb-3">
                   <button @click="saveStudent" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default{
    name:'studentsCreate',
    data(){
        return {
            errorList:'',
            model:{
                student : {
                    name: '',
                    phone: '',
                    email: '',
                    courses: '',
                }
            }
        }
    },
    methods:{
        saveStudent(){
            var mythis = this;
            axios.post('http://localhost:8000/api/students',this.model.student).then(res=>{
                console.log(res.data);
                alert(res.data.data.message);
                this.model.student={
                    name:'',
                    course:'',
                    email:'',
                    phone:'',
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
        }
    }
}



</script>