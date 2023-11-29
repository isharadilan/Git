<script>
import { onMounted } from 'vue';
import axios from 'axios';
import { ref } from 'vue';

export default {
  components: {
    AppLayout
  },

  setup() {
    const student_list = ref([]);
    const student = ref({
      name: '',
      image: '',
      age: ''
    });

    const handleImageChange = (event) => {
      student.value.image = event.target.files[0];
    };

    const studentStore = async () => {
      try {
        let formData = new FormData();
        formData.append('name', student.value.name);
        formData.append('image', student.value.image);
        formData.append('age', student.value.age);

        // Make the post request to store the new student
        await axios.post(route('students.store'), formData);

        // Fetch the updated list of students after the addition
        await loadStudents();

        // Clear the form fields after submission
        student.value = {
          name: '',
          image: '',
          age: ''
        };
      } catch (error) {
        console.error('Error storing student:', error);
      }
    };

    const loadStudents = async () => {
      try {
        // Fetch the updated list of students
        const updatedStudents = (await axios.get(route('students.index'))).data.students;
        student_list.value = updatedStudents;
      } catch (error) {
        console.error('Error loading students:', error);
      }
    };

    const deleteStudent = async (studentId) => {
      try {
        // Make the delete request to remove the student
        await axios.delete(route('students.delete', studentId));

        // Fetch the updated list of students after the deletion
        await loadStudents();
      } catch (error) {
        console.error('Error deleting student:', error);
      }
    };

    // Fetch the initial list of students when the component is mounted
    onMounted(loadStudents);

    return {
      student_list,
      handleImageChange,
      studentStore,
      deleteStudent
    };
  }
};
</script>
