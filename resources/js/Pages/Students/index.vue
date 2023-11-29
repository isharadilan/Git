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
                <form @submit.prevent="studentStore"
                      style="background-color: #f2f2f2; padding: 20px; border-radius: 10px; max-width: 400px; margin: auto;">

                  <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input class="form-control" name="name" v-model="student.name" type="text" placeholder="Enter Name" required>
                  </div>

                  <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input class="form-control" name="image" type="file" accept="image/jpg, image/jpeg, image/png" @change="handleImageChange" required>
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
                    <span v-if="student.active === 0" class="badge bg-warning">Inactive</span>
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
      }
    }
  };
  </script>

  <style lang="scss" scoped>

  </style>
