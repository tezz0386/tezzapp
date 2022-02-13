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
                    <label for="name">Title:</label>
                    <input
                      type="text"
                      name="title"
                      id="title"
                      v-model="this.service.title"
                      class="form-control form-control-sm"
                    />
                  </div>
                  <div class="form-group">
                    <label for="name">Choose Image:</label>
                    <input
                      type="file"
                      name="image"
                      id="image"
                      class="form-control form-control-sm"
                      @change="onFileChange"
                    />
                    <img
                      v-bind:src="imagePreview"
                      width="500"
                      height="300"
                      v-show="showPreview"
                    />
                  </div>
                  <div class="form-group">
                    <label for="name">URL:</label>
                    <input
                      type="text"
                      name="url"
                      id="url"
                      v-model="this.service.url"
                      class="form-control form-control-sm"
                    />
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="name">Type:</label>
                        <input
                          type="text"
                          name="type"
                          id="type"
                          v-model="this.service.type"
                          class="form-control form-control-sm"
                        />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="name">Is This Developed:</label>
                        <select
                          name="is_developed"
                          id="is_developed"
                          v-model="this.service.is_developed"
                          class="form-control form-control-sm"
                        >
                          <option value="yes" :selected="true">Yes</option>
                          <option value="no">No</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="summary">Summary:</label>
                    <textarea
                      name="summary"
                      id="summary"
                      rows="3"
                      v-model="this.service.summary"
                      class="form-control"
                    ></textarea>
                  </div>
                  <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea
                      name="description"
                      id="description"
                      rows="3"
                      v-model="this.service.description"
                      class="form-control editor"
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
                  <h3 class="card-title">SEO</h3>
                  <div class="card-tools">
                    <button
                      type="button"
                      class="btn btn-tool"
                      data-card-widget="collapse"
                    >
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body" style="display: block">
                  <div class="form-group">
                    <label for="title_tag">Title Tag:</label>
                    <input
                      type="text"
                      class="form-control form-control-sm"
                      name="title_tag"
                      id="title_tag"
                      v-model="this.service.title_tag"
                    />
                  </div>
                  <div class="form-group">
                    <label for="meta_keywords">Meta Keywords:</label>
                    <textarea
                      name="meta_keywords"
                      id="meta_keywords"
                      class="form-control"
                      rows="3"
                      v-model="this.service.meta_keywords"
                    ></textarea>
                  </div>
                  <div class="form-group">
                    <label for="meta_description">Meta Description:</label>
                    <textarea
                      name="meta_description"
                      id="meta_description"
                      class="form-control"
                      rows="3"
                      v-model="this.service.meta_description"
                    ></textarea>
                  </div>
                </div>
              </div>
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
                      v-model="this.service.status"
                      class="form-control form-control-sm"
                    >
                      <option value="active" :selected="true">Active</option>
                      <option value="inactive">Inactive</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <button
                      class="btn btn-primary"
                      v-on:click="updateservice"
                      type="button"
                    >
                      Update
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
  name: "serviceEdit",
  data() {
    return {
      service: {},
      name: null,
      activePage: "service_create",
      page: "service",
      imagePreview: null,
      showPreview: false,
    };
  },
  created() {
    this.$Progress.start();
    if (window.Laravel.user) {
      this.name = window.Laravel.user.name;
    }
    this.$axios.get("/snactum/csrf-cookie").then((response) => {
      this.$axios
        .get(
          window.Laravel.base_url + "admin/service/" + this.$route.params.id
        )
        .then((response) => {
          console.log(response.data.message);
          this.service = response.data.service;
          this.$Progress.finish();
          this.showPreview = true;
          this.imagePreview =
            "/uploads/services/thumbnail/" + this.service.image;
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.load = false;
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
    onFileChange(event) {
      /*
    Set the local file variable to what the user has selected.
    */
      // this.formData.picture = event.target.files[0];
      this.service.image = event.target.files[0];
      /*
    Initialize a File Reader object
    */
      let reader = new FileReader();

      /*
    Add an event listener to the reader that when the file
    has been loaded, we flag the show preview as true and set the
    image to be what was read from the reader.
    */
      reader.addEventListener(
        "load",
        function () {
          this.showPreview = true;
          this.imagePreview = reader.result;
        }.bind(this),
        false
      );

      /*
    Check to see if the file is not empty.
    */
      if (this.service.image) {
        /*
            Ensure the file is an image file.
        */
        if (/\.(jpe?g|png|gif)$/i.test(this.service.image.name)) {
          console.log("here");
          /*
            Fire the readAsDataURL method which will read the file in and
            upon completion fire a 'load' event which we will listen to and
            display the image in the preview.
            */
          reader.readAsDataURL(this.service.image);
        }
      }
    },
    updateservice() {
      this.$Progress.start();
      let formData = new FormData();
      formData.append("image", this.service.image);
      formData.append("title", this.service.title);
      formData.append("url", this.service.url);
      formData.append("summary", this.service.summary);
      formData.append("description", this.service.description);
      formData.append("title_tag", this.service.title_tag);
      formData.append("meta_keywords", this.service.meta_keywords);
      formData.append("meta_description", this.service.meta_description);
      formData.append("type", this.service.type);
      formData.append("is_developed", this.service.is_developed);
      formData.append("status", this.service.status);
      formData.append("_method", "PATCH");
      this.$axios.get("/sanctum/csrf-cookie").then((response) => {
        this.$axios
          .post(
            window.Laravel.base_url + "admin/service/" + this.service.id,
            formData
          )
          .then((response) => {
            this.service = response.data.service;
            console.log(response);
            this.$Progress.finish();
            this.$swal.fire({
              icon: "success",
              title: "Success !!!",
              text: "Successfully Updated",
            });
            this.$router.replace("/admin/service");
          })
          .catch(function (error) {
            console.error(error);
            this.$swal.fire({
              icon: "error",
              title: "Oppss !!!",
              text: "Could not be updated",
              footer: '<a href="">Why do I have this issue?</a>',
            });
          });
      });
    },
  },
};
</script>
