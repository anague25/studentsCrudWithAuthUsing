
import { RouterLink } from 'vue-router';
<template>
    <div class="container">

        <div class="card">
            <div class="card-header">
                <h4>Students <RouterLink to="/students/create" class="btn btn-primary float-end">Add student</RouterLink>
                </h4>
            </div>
            <div class="card-body">

                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody v-if="this.students.length > 0" class="align-middle">
                        <tr v-for="(student,index) in this.students" :key="index">
                            <td>{{ student.id }}</td>
                            <td>{{ student.name }}</td>
                            <td>{{ student.courses }}</td>
                            <td>{{ student.email }}</td>
                            <td>{{ student.phone }}</td>
                            <td>{{ student.created_at }}</td>
                            <td class="d-flex justify-content-center"><RouterLink :to="{path: '/students/'+student.id+'/edit'}" class="btn btn-primary mx-1">Edit student</RouterLink>
                            <button type="button" @click="deleteStudent(student.id)" class="btn btn-danger mx-1">Delete student</button>
                            </td>
                           
                           
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr>
                            <td colspan="7">Loding ...</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: 'students',
    data() {
        return {
            students: [],
        }
    },

    mounted() {
        // console.log('it\'s fine');
        this.getStudent();
        
    },

    methods: {
        getStudent() {
            
            axios.get('http://localhost:8000/api/students',{
                headers: {
        Authorization: `Bearer ${localStorage.getItem('token')}`
      }
            }).then(res => {
                this.students = res.data.data;
                console.log(this.students);
            });
        },

        deleteStudent(studentId){
            if(confirm('are you sure ,you want to delete this data?')){

                // console.log(studentId);
                axios.delete(`http://localhost:8000/api/students/${studentId}`).then(res=>{
                    alert('student was deleted successfully');
                    this.getStudent();
                }).catch(function(error){
                if(error.response){
                    if(error.response.status == 404){
                        // mythis.errorList = error.response.data.errors;
                        // console.log(error.response);
                        alert('students not found');
                    }
                }
            });;
            }
        }

    },
}
</script>