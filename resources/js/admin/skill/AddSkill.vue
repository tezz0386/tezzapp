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
          <!-- <form action=""> -->
          <div class="row">
            <div class="col-md-8">
              <div
                class="card card-default"
                style="border-top: 3px solid #3c8dbc !important"
              >
                <div class="card-header">
                  <h3 class="card-title">Details</h3>
                  <div class="card-tools">
                    <button
                      type="button"
                      class="btn btn-tool"
                      data-card-widget="collapse"
                    >
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body" style="display: block">
                  <div class="form-group">
                    <label for="name">Skill Title:</label>
                    <input
                      type="text"
                      name="title"
                      id="title"
                      v-model="this.skill.title"
                      class="form-control form-control-sm"
                    />
                  </div>
                  <div class="form-group">
                    <label>Skill Out of 100%</label>
                    <div class="input-group input-group-sm">
                      <input type="number" class="form-control" name="precentage" v-model="this.skill.precentage">
                      <div class="input-group-append">
                        <span class="input-group-text"
                          >%</span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="name">Content:</label>
                    <textarea
                      name="content"
                      id="content"
                      rows="3"
                      v-model="this.skill.content"
                      class="form-control"
                    ></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div
                class="card card-default"
                style="border-top: 3px solid #3c8dbc !important"
              >
                <div class="card-header">
                  <h3 class="card-title">Action</h3>
                  <div class="card-tools">
                    <button
                      type="button"
                      class="btn btn-tool"
                      data-card-widget="collapse"
                    >
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body" style="display: block">
                  <div class="form-group">
                    <label for="status">Status::</label>
                    <select
                      name="status"
                      id="status"
                      v-model="this.skill.status"
                      class="form-control form-control-sm"
                    >
                      <option value="active" :selected="true">Active</option>
                      <option value="inactive">Inactive</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <button
                      class="btn btn-primary"
                      v-on:click="addSkill"
                      type="button"
                    >
                      Save
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- </form> -->
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

export default {
  components: { AdminHeader, Sidebar, Breadcrumb, Footer },
  name: "AddSkill",
  data() {
    return {
      skill: {},
      name: null,
      activePage: "skill_create",
      page: "skill",
    };
  },
  created() {
    this.$Progress.start();
    if (window.Laravel.user) {
      this.name = window.Laravel.user.name;
    }
    this.skill.status = "active";
    this.$Progress.finish();
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
    addSkill() {
      this.$Progress.start();
      let formData = new FormData();
      formData.append("title", this.skill.title);
      formData.append("content", this.skill.content);
      formData.append("precentage", this.skill.precentage);
      formData.append("status", this.skill.status);
      this.$axios.get("/sanctum/csrf-cookie").then((response) => {
        this.$axios
          .post(window.Laravel.base_url + "admin/skill", formData)
          .then((response) => {
            this.skill = {};
            console.log(response.data.message);
            console.log(response);
            this.$Progress.finish();
            this.$swal.fire({
              icon: "success",
              title: "Success !!!",
              text: "Successfully Saved",
            });
            this.$router.replace("/admin/skill");
          })
          .catch(function (error) {
            console.error(error);
            this.$swal.fire({
              icon: "error",
              title: "Oppss... !!!",
              text: "Could not Saved",
              footer: '<a href="">Why do I have this issue?</a>',
            });
          });
      });
    },
  },
};
</script>
