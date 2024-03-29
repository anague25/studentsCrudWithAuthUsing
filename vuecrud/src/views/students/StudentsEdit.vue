<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Edit Students</h4>
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
                   <button @click="updateStudent" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default{
    name:'studentsEdit',
    data(){
        return {
            errorList:'',
            studentId:'',
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
    mounted(){
        this.studentId = this.$route.params.id;
        this.getStudentData(this.$route.params.id);
    },
    methods:{
        updateStudent(){
            var mythis = this;
            axios.put(`http://localhost:8000/api/students/${this.studentId}`,this.model.student).then(res=>{
                console.log(res.data);
                alert('operation successfully');
               
                this.errorList = '';
            }).catch(function (error) {
                if (error.response) {
                    if(error.response.status = 422){
                        mythis.errorList = error.response.data.errors;
                    }

                    if(error.response.status == 404){
                        // mythis.errorList = error.response.data.errors;
                        // console.log(error.response.data);
                        alert('students not found');
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
        getStudentData(studentId){
            axios.get(`http://localhost:8000/api/students/${studentId}`).then(res=>{
                this.model.student = res.data.data;
                // this.model.student.name = res.data.data.name;
                // this.model.student.courses = res.data.data.courses;
                // this.model.student.email = res.data.data.email;
                // this.model.student.phone = res.data.data.phone;
            }).catch(function(error){
                if(error.response){
                    if(error.response.status == 404){
                        // mythis.errorList = error.response.data.errors;
                        console.log(error.response);
                        alert('students not found');
                    }
                }
            });
        }
    }
}



</script>

<!-- Route::post('/login',[AuthController::class, 'login']);
Route::post('/register',[AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function(){

    Route::apiResource('/students', StudentsController::class);
}); -->
    
