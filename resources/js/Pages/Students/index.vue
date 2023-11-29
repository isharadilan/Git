<template>
    <AppLayout>
      <template #content>
        <div class="container">
          <div class="row">
            <div class="col-lg-12 text-center">
              <h1 class='page-title' style="color: #6c757d; font-size: 2.5rem; margin-top: vh;">My Students List</h1>
            </div>
          </div>

          <div class="col-lg-8 mx-auto">
            <div class="row">
              <div class="col-lg-6 mb-4">
                <img src="https://free-vectors.net/_ph/10/924162920.jpg" alt="Vector Image" class="img-fluid">
              </div>

              <div class="col-lg-6">
                <form @submit.prevent="studentStore" enctype="multipart/form-data"
                      style="background-color: #f2f2f2; padding: 20px; border-radius: 10px; max-width: 400px; margin: auto;">
                  <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input class="form-control" name="name" v-model="student.name" type="text" placeholder="Enter Name" required>
                  </div>
                  <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input class="form-control" name="image" type="file" @change="handleImageChange" required>
                  </div>
                  <div class="mb-3">
                    <label for="age" class="form-label">Age</label>
                    <input class="form-control" name="age" v-model="student.age" type="number" placeholder="Enter Age" required>
                  </div>
                  <div class="text-center">
                    <button class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="col-lg-12 mt-5">
            <table class="table table-hover">
              <thead class="table-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Image</th>
                  <th scope="col">Age</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(student, key) in students" :key="key">
                  <th scope="row">{{ key + 1 }}</th>
                  <td>{{ student.name }}</td>
                  <td><img :src="student.image" width="50" height="50"></td>
                  <td>{{ student.age }}</td>
                  <td>
                    <span v-if="student.status === 0" class="badge bg-warning">Inactive</span>
                    <span v-else class="badge bg-success">Active</span>
                  </td>
                  <td>
                    <a :href="route('students.delete', student.id)" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                    <a :href="route('students.active', student.id)" class="btn btn-success"><i class="far fa-solid fa-eye"></i></a>
                    <a href="javascript:void(0)" class="btn btn-info" @click="studentEditModal(student.id)"><i class="fas fa-edit"></i></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </template>

      <template #modal>
        <div class="modal fade" id="studentEditModal" tabindex="-1" aria-labelledby="studentEditLabel" aria-hidden="true" ref="studentEditModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="studentEditLabel">Edit Student Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form @submit.prevent="updateStudent" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input class="form-control" name="name" v-model="student_Update.name" type="text" placeholder="Enter Name" required>
                  </div>
                  <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input class="form-control" name="image" type="file" @change="handleImageChange" required>
                  </div>
                  <div class="mb-3">
                    <label for="age" class="form-label">Age</label>
                    <input class="form-control" name="age" v-model="student_Update.age" type="number" placeholder="Enter Age" required>
                  </div>
                  <div class="text-center">
                    <button class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </template>
    </AppLayout>
  </template>

  <script>
  import AppLayout from '@/Layouts/App.vue';
  import axios from 'axios';

  export default {
    components: {
      AppLayout
    },
    props: {
      students: Array
    },
    data() {
      return {
        student: {
          name: '',
          image: '',
          age: ''
        },
        student_Update: {
          id: 0,
          name: '',
          image: '',
          age: ''
        }
      };
    },
    methods: {
      handleImageChange(event) {
        this.student.image = event.target.files[0];
      },
      async studentStore() {
        let formData = new FormData();
        formData.append('name', this.student.name);
        formData.append('image', this.student.image);
        formData.append('age', this.student.age);

        await axios.post(route('students.store'), formData);
      },
      async studentEditModal(studentId) {
        try {
          const response = await axios.get(route('students.get', studentId));
          this.student_Update = {
            id: studentId,
            name: response.data.student.name,
            age: response.data.student.age,
            image: ''
          };

          const modal = new bootstrap.Modal(this.$refs.studentEditModal);
          modal.show();
        } catch (error) {
          console.error('Error fetching student details:', error);
        }
      },
      async updateStudent() {
        try {
          await axios.post(route('students.update', this.student_Update.id), this.student_Update);
          const modal = new bootstrap.Modal(this.$refs.studentEditModal);
          modal.hide();
        } catch (error) {
          console.error('Error updating student details:', error);
        }
      },
      async deleteStudent(studentId) {
        await axios.get(route('students.delete', studentId));

      },
      async toggleStudentStatus(studentId) {
        await axios.get(route('students.active', studentId));

      }
    }
  };
  </script>

  <style lang="scss" scoped>

  </style>
