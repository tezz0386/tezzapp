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
                      v-model="this.blog.title"
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
                      width="250"
                      height="250"
                      v-show="showPreview"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div
                class="card card-default collapsed-card"
                style="border-top: 3px solid rgb(60, 141, 188) !important"
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
                <div class="card-body" style="display: none">
                  <div class="form-group">
                    <label for="title_tag">Title Tag:</label>
                    <input
                      type="text"
                      class="form-control form-control-sm"
                      name="title_tag"
                      id="title_tag"
                      v-model="this.blog.title_tag"
                    />
                  </div>
                  <div class="form-group">
                    <label for="meta_keywords">Meta Keywords:</label>
                    <textarea
                      name="meta_keywords"
                      id="meta_keywords"
                      class="form-control"
                      rows="3"
                      v-model="this.blog.meta_keywords"
                    ></textarea>
                  </div>
                  <div class="form-group">
                    <label for="meta_description">Meta Description:</label>
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
                      v-model="this.blog.status"
                      class="form-control form-control-sm"
                    >
                      <option value="active" :selected="true">Active</option>
                      <option value="inactive">Inactive</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <button
                      class="btn btn-primary"
                      v-on:click="addblog"
                      type="button"
                    >
                      Save
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-lg-12">
              <div
                class="card card-default"
                style="border-top: 3px solid rgb(60, 141, 188) !important"
              >
                <div class="card-header">
                  <h3 class="card-title">Others</h3>
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
                    <label for="summary">Summary:</label>
                    <textarea
                      name="summary"
                      id="summary"
                      rows="3"
                      v-model="this.blog.summary"
                      class="form-control"
                    ></textarea>
                  </div>
                  <div class="form-group">
                    <label for="description">Description:</label>
                    <ckeditor
                      :editor="editor"
                      v-model="this.blog.content"
                      :config="editorConfig"
                    ></ckeditor>
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

import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

export default {
  components: { AdminHeader, Sidebar, Breadcrumb, Footer },
  name: "blogCreate",
  data() {
    return {
      blog: {},
      name: null,
      activePage: "blog_create",
      page: "blog",
      imagePreview: null,
      showPreview: false,
      editor: ClassicEditor,
      editorConfig: {
        toolbar: [
          "heading",
          "|",
          "textPartLanguage",
          "bold",
          "italic",
          "link",
          "bulletedList",
          "numberedList",
          "|",
          "outdent",
          "indent",
          "|",
          "imageUpload",
          "blockQuote",
          "insertTable",
          "mediaEmbed",
          "undo",
          "redo",
          "alignment",
          "fontColor",
          "fontFamily",
          "fontBackgroundColor",
          "fontSize",
          "highlight",
          "CKFinder",
          "findAndReplace",
        ],
        ckfinder: {
          uploadUrl:
            "/ckeditor/ckfinder/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json",
        },
        language: "en",
        image: {
          toolbar: [
            "imageTextAlternative",
            "imageStyle:inline",
            "imageStyle:block",
            "imageStyle:side",
            "linkImage",
          ],
        },
      },
    };
  },
  created() {
    this.$Progress.start();
    if (window.Laravel.user) {
      this.name = window.Laravel.user.name;
    }
    this.blog.status = "active";
    this.blog.is_developed = "yes";
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
    onFileChange(event) {
      /*
    Set the local file variable to what the user has selected.
    */
      // this.formData.picture = event.target.files[0];
      this.blog.image = event.target.files[0];
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
      if (this.blog.image) {
        /*
            Ensure the file is an image file.
        */
        if (/\.(jpe?g|png|gif)$/i.test(this.blog.image.name)) {
          console.log("here");
          /*
            Fire the readAsDataURL method which will read the file in and
            upon completion fire a 'load' event which we will listen to and
            display the image in the preview.
            */
          reader.readAsDataURL(this.blog.image);
        }
      }
    },
    addblog() {
      this.$Progress.start();
      let formData = new FormData();
      formData.append("image", this.blog.image);
      formData.append("title", this.blog.title);
      formData.append("summary", this.blog.summary);
      formData.append("content", this.blog.content);
      formData.append("title_tag", this.blog.title_tag);
      formData.append("meta_keywords", this.blog.meta_keywords);
      formData.append("meta_description", this.blog.meta_description);
      formData.append("status", this.blog.status);
      this.$axios.get("/sanctum/csrf-cookie").then((response) => {
        this.$axios
          .post(window.Laravel.base_url + "admin/blog", formData)
          .then((response) => {
            this.blog = {};
            console.log(response.data.message);
            console.log(response);
            this.$Progress.finish();
            this.$swal.fire({
              icon: "success",
              title: "Success !!!",
              text: "Successfully Saved",
            });
            this.$router.replace("/admin/blog");
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
