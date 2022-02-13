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
                  <th>Thumb</th>
                  <th>Created At</th>
                  <th>Status</th>
                  <th colspan="2">Action</th>
                </tr>
              </thead>
               <draggable v-model="blogs" tag="tbody" item-key="title" @add="onAdd($event, false)"  @change="update" class="image-table">
                <template #item="{ element }" :data-id="element.id">
                <tr>
                  <td>{{element.order}}</td>
                  <td>
                    <a :href="element.url" target="_blank">
                      {{ element.title }}
                    </a>
                  </td>
                  <td>
                    <img
                      v-bind:src="'/uploads/blogs/thumbnail/' + element.image"
                      alt="thumb"
                      height="100"
                      width="150"
                    />
                  </td>
                  <td>
                    {{ element.created_at }}
                  </td>
                  <td>{{ element.status }}</td>
                  <td>
                    <router-link
                      :to="{ name: 'blog-edit', params: { id: element.id } }"
                    >
                      <i class="fa fa-edit"></i>
                    </router-link>
                    <i class="fa fa-trash" v-on:click="deleteblog(element.id)"></i>
                  </td>
                </tr>
                </template>
               </draggable>
            </table>
            <!-- <rawDisplayer class="col-3" :value="this.blogs" title="List" /> -->
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
  name: "blogList",
  display: "Table",
  order: 8,
  data() {
    return {
      blogs: [],
      name: null,
      activePage: "blog_list",
      page: "blog",
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
        .get(window.Laravel.base_url + "admin/blog")
        .then((response) => {
          this.blogs = response.data.blogs;
          console.log(response.data.message);
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
    deleteblog(id) {
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
              this.$axios.delete(window.Laravel.base_url+'admin/blog/'+id)
              .then((response)=>{
                      let i = this.blogs.map(item => item.id).indexOf(id); // find index of your object
                        this.blogs.splice(i, 1)
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
                this.blogs.map((blogs, index) => {
                    blogs.order = index + 1;
                });

                this.blogs.map((blogs, index) => {
                    blogs.order = index + 1;
                });

                let blogs = this.blogs.concat(this.tasksCompletedNew);
                this.$axios.get('/snactum/csrf-cookie').then((response)=>{
                  this.$axios.patch(window.Laravel.base_url+'admin/update-order/blog', {
                    blogs: blogs
                  }).then((response) => {
                    console.log(response.data);
                  }).catch((error) => {
                    console.log(error);
                  })
                });
                console.log(this.blogs);
            },
  },
};
</script>
