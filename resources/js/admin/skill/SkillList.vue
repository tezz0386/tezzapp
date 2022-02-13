<template>
  <div class="wrapper">
    <admin-header />

    <sidebar
      :activePage="this.activePage"
      :page="this.page"
      :name="this.name"
    />
    <div class="content-wrapper">
      <breadcrumb />

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Progress</th>
                  <th>Created At</th>
                  <th>Status</th>
                  <th colspan="2">Action</th>
                </tr>
              </thead>
               <draggable v-model="lists" tag="tbody" item-key="title" @add="onAdd($event, false)"  @change="update">
                <template #item="{ element }" :data-id="element.id">
                <tr>
                  <td scope="row">{{element.order}}</td>
                  <td>
                    {{ element.title }}
                  </td>
                  <td>
                      <span>PHP</span> <span class="pull-right">{{element.precentage}}%</span>
                      <div class="progress my-progressbar">
                        <div class="progress-bar" role="progressbar" :style="{width:element.precentage+'%'}" aria-valuenow="{{element.precentage}}" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                  </td>
                  <td>
                    {{element.created_at}}
                  </td>
                  <td>{{ element.status }}</td>
                  <td>
                    <router-link :to="{name:'skill-edit', params: {id: element.id}}">
                      <i class="fa fa-edit"></i>
                    </router-link>
                    <i class="fa fa-trash" v-on:click="deleteSkill(element.id)"></i>
                  </td>
                </tr>
                </template>
               </draggable>
            </table>
            <!-- <rawDisplayer class="col-3" :value="this.lists" title="List" /> -->
          </div>
        </div>
      </section>
    </div>
    <footer />
  </div>
</template>
<script>
import AdminHeader from "../shared/AdminHeader.vue";
import Breadcrumb from "../shared/Breadcrumb.vue";
import Footer from "../shared/Footer.vue";
import Sidebar from "../shared/Sidebar.vue";
import draggable from 'vuedraggable'

export default {
  components: { AdminHeader, Sidebar, Breadcrumb, Footer, draggable },
  name: "SkillList",
  display: "Table",
  order: 8,
  data() {
    return {
      lists: [],
      name: null,
      activePage: "skill_list",
      page: "skill",
      imagePreview: null,
      showPreview: false,
      dragging: false
    };
  },
  created() {
    this.$Progress.start();
    if (window.Laravel.user) {
      this.name = window.Laravel.user.name;
    }
    this.$axios.get("/snactum/csrf-cookie").then((response) => {
      this.$axios
        .get(window.Laravel.base_url + "admin/skill")
        .then((response) => {
          this.lists = response.data.skills;
          console.log(response.data.message);
          console.log(response.data.skills);
          this.$Progress.finish();
        })
        .catch((error) => {
          console.log(error);
        });
    });
  },
  beforeRouteEnter(to, from, next) {
    if (!window.Laravel.isLoggedin) {
      window.location.href = "/";
    }
    if (window.Laravel.user.role == "user") {
      window.location.href = "/user/home";
    }
    next();
  },
  methods: {
    deleteSkill(id) {
      this.$swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          let formData = new FormData();
          formData.append('_method', 'DELETE');
          this.$axios.get('/snactum/csrff-cookie').then((response)=>{
              this.$axios.delete(window.Laravel.base_url+'admin/skill/'+id)
              .then((response)=>{
                      let i = this.lists.map(item => item.id).indexOf(id); // find index of your object
                        this.lists.splice(i, 1)
                   this.$swal.fire({
                     icon:'warning',
                     title: 'Deleted !!!',
                     text: 'Successfully Deleted',
                   });
              })
              .catch((error)=>{
                console.log(error);
                this.$swal.fire({
                     icon:'error',
                     title: 'Oppsss.. !!!',
                     text: 'Could not be Deleted',
                   });
              })
          });
        }
      });
    },
     onAdd(event, status) {
                // let id = event.item.getAttribute('data-id');
                // axios.patch('/demos/tasks/' + id, {
                //     status: status
                // }).then((response) => {
                //     console.log(response.data);
                // }).catch((error) => {
                //     console.log(error);
                // })
            },
            update() {
                this.lists.map((lists, index) => {
                    lists.order = index + 1;
                });

                this.lists.map((lists, index) => {
                    lists.order = index + 1;
                });

                let lists = this.lists.concat(this.tasksCompletedNew);
                this.$axios.get('/snactum/csrf-cookie').then((response)=>{
                  this.$axios.patch(window.Laravel.base_url+'admin/update-order/skill', {
                    skills: lists
                  }).then((response) => {
                    console.log(response.data);
                  }).catch((error) => {
                    console.log(error);
                  })
                });
                console.log(this.lists);
            },
  },
};
</script>
