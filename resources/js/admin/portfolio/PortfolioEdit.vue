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
                      v-model="this.portfolio.title"
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
                      v-model="this.portfolio.url"
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
                          v-model="this.portfolio.type"
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
                          v-model="this.portfolio.is_developed"
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
                      v-model="this.portfolio.summary"
                      class="form-control"
                    ></textarea>
                  </div>
                  <div class="form-group">
                    <label for="description">Description:</label>
                    <ckeditor
                      :editor="editor"
                      v-model="this.portfolio.description"
                      :config="editorConfig"
                    ></ckeditor>
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
                      v-model="this.portfolio.title_tag"
                    />
                  </div>
                  <div class="form-group">
                    <label for="meta_keywords">Meta Keywords:</label>
                    <textarea
                      name="meta_keywords"
                      id="meta_keywords"
                      class="form-control"
                      rows="3"
                      v-model="this.portfolio.meta_keywords"
                    ></textarea>
                  </div>
                  <div class="form-group">
                    <label for="meta_description">Meta Description:</label>
                    <textarea
                      name="meta_description"
                      id="meta_description"
                      class="form-control"
                      rows="3"
                      v-model="this.portfolio.meta_description"
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
                      v-model="this.portfolio.status"
                      class="form-control form-control-sm"
                    >
                      <option value="active" :selected="true">Active</option>
                      <option value="inactive">Inactive</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <button
                      class="btn btn-primary"
                      v-on:click="updatePortfolio"
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
  name: "PortfolioEdit",
  data() {
    return {
      portfolio: {},
      name: null,
      activePage: "portfolio_create",
      page: "portfolio",
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
          window.Laravel.base_url + "admin/portfolio/" + this.$route.params.id
        )
        .then((response) => {
          console.log(response.data.message);
          this.portfolio = response.data.portfolio;
          this.$Progress.finish();
          this.showPreview = true;
          this.imagePreview =
            "/uploads/portfolios/thumbnail/" + this.portfolio.image;
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
      this.portfolio.image = event.target.files[0];
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
      if (this.portfolio.image) {
        /*
            Ensure the file is an image file.
        */
        if (/\.(jpe?g|png|gif)$/i.test(this.portfolio.image.name)) {
          console.log("here");
          /*
            Fire the readAsDataURL method which will read the file in and
            upon completion fire a 'load' event which we will listen to and
            display the image in the preview.
            */
          reader.readAsDataURL(this.portfolio.image);
        }
      }
    },
    updatePortfolio() {
      this.$Progress.start();
      let formData = new FormData();
      formData.append("image", this.portfolio.image);
      formData.append("title", this.portfolio.title);
      formData.append("url", this.portfolio.url);
      formData.append("summary", this.portfolio.summary);
      formData.append("description", this.portfolio.description);
      formData.append("title_tag", this.portfolio.title_tag);
      formData.append("meta_keywords", this.portfolio.meta_keywords);
      formData.append("meta_description", this.portfolio.meta_description);
      formData.append("type", this.portfolio.type);
      formData.append("is_developed", this.portfolio.is_developed);
      formData.append("status", this.portfolio.status);
      formData.append("_method", "PATCH");
      this.$axios.get("/sanctum/csrf-cookie").then((response) => {
        this.$axios
          .post(
            window.Laravel.base_url + "admin/portfolio/" + this.portfolio.id,
            formData
          )
          .then((response) => {
            this.portfolio = response.data.portfolio;
            console.log(response);
            this.$Progress.finish();
            this.$swal.fire({
              icon: "success",
              title: "Success !!!",
              text: "Successfully Updated",
            });
            this.$router.replace("/admin/portfolio");
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
<style>
.ck-editor__editable {
  min-height: 300px;
}
</style>
