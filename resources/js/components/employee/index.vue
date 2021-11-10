<template>
    <div>
        <router-link to="/store-employee" class="btn btn-primary">Add Employees</router-link>

      <div class="pt-3">
      <input type="text" class="form-control" placeholder="Search here"
      v-model="searchTerm" style="width:300px;">
      </div>
        <div class="row pt-3">
        <div class="col-lg-12 mb-4">
          <!-- Simple Tables -->
          <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Employee List</h6>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th>Name</th>
                    <th>Photo</th>
                    <th>Phone</th>
                    <th>Sallery</th>
                    <th>Join Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="employee in filtersearch" :key="employee.id">
                    <td><a href="#">{{employee.name}}</a></td>
                    <td> <img :src="employee.photo" id="em_photo"></td>
                    <td>{{employee.phone}}</td>
                    <td>{{employee.sallery}}</td>
                    <td>{{employee.join_date}}</td>
                    <td>
                        <router-link :to="{name:'editemployee', params:{id:employee.id} }"
                        class="btn btn-primary">edit</router-link>
                        <a @click="deleteEmployee(employee.id)" style="color:white;"
                        class="btn btn-danger">delete</a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="card-footer"></div>
          </div>
        </div>
      </div>
      <!--Row-->
    </div>
</template>
<script>
export default {
    data(){
        return{
            employees:[],
            searchTerm:''
        }
    },
    computed:{
      filtersearch(){
        return this.employees.filter(employee=>{
          return employee.name.match(this.searchTerm)
        });
      }
    },
    methods:{
        allEmployee(){
            axios.get('/api/employee')
            .then(({data})=>(this.employees = data))
            .catch()
        },
        deleteEmployee(id){
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {
                axios.delete('/api/employee/'+id)
                .then(()=>{
                  this.employees = this.employees.filter(employee=>{
                    return employee.id != id;
                  })
                }).catch(()=>{
                  this.$router.push({name:'employee'})
                })
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
              }
            })
        }
    },
    created(){
        this.allEmployee();
    }
}
</script>

<style>
    #em_photo
    {
        width: 40px;
        height: 40px;
        object-fit: cover;
    }
</style>
