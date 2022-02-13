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
              <div class="col-md-2"></div>
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
                  <div class="box-profile">
                    <div class="text-center">
                      <img
                        class="profile-user-img img-fluid img-circle"
                         v-bind:src="imagePreview"
                        alt="User profile picture"
                      />
                      <br />
                      <input type="file" name="profile_image" @change="onFileChange" />
                      <button
                        type="button"
                        class="btn btn-primary btn-sm"
                        v-if="showUpload"
                        @click="updateProfile"
                      >
                        Upload
                      </button>
                    </div>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                        <div class="form-group">
                          <label>Designation:</label>
                          <div class="input-group input-group-sm">
                            <input
                              type="text"
                              class="form-control"
                              placeholder="Your Designation"
                              v-model="this.user.designation"
                            />
                            <div class="input-group-append">
                              <button class="input-group-text" @click="updateDesignation">Update</button>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="form-group">
                          <label>Name:</label>
                          <div class="input-group input-group-sm">
                            <input
                              type="text"
                              class="form-control"
                              placeholder="Your Name"
                              v-model="this.user.name"
                            />
                            <div class="input-group-append">
                              <button class="input-group-text" @click="updateName">Update</button>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="form-group">
                          <label>Email:</label>
                          <div class="input-group input-group-sm">
                            <input
                              type="text"
                              class="form-control"
                              placeholder="Your Email"
                              v-model="this.user.email"
                            />
                            <div class="input-group-append">
                              <button class="input-group-text" @click="updateEmail">Update</button>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="form-group">
                          <label>Contact No:</label>
                          <div class="input-group input-group-sm">
                            <input
                              type="text"
                              class="form-control"
                              placeholder="Your contact no"
                              v-model="this.user.contact_no"
                            />
                            <div class="input-group-append">
                              <button class="input-group-text" @click="updateContact">Update</button>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="form-group">
                          <label>CV:</label>
                          <div class="input-group input-group-sm">
                            <input
                              type="file"
                              class="form-control"
                            />
                            <div class="input-group-append">
                              <button class="input-group-text" @click="updateCV">Update</button>
                            </div>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-12 col-lg-12">
              <div
                class="card card-default"
                style="border-top: 3px solid rgb(60, 141, 188) !important"
              >
                <div class="card-header">
                  <h3 class="card-title">About Me</h3>
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
                      v-model="this.user.summary"
                      class="form-control"
                    ></textarea>
                  </div>
                  <div class="form-group">
                    <label for="description">Description:</label>
                    <ckeditor
                      :editor="editor"
                      v-model="this.user.description"
                      :config="editorConfig"
                    ></ckeditor>
                  </div>
                  <div class="form-group">
                      <button class="btn btn-sm btn-primary float-right" @click="updateAbout">Update</button>
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
  name: "ProfileEdit",
  data() {
    return {
      user: {},
      name: null,
      activePage: "profile_edit",
      page: "profile",
      imagePreview: null,
      showPreview: false,
      editor: ClassicEditor,
      showUpload: false,
      imagePreview:null,
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
     this.$axios.get("/snactum/csrf-cookie").then((response) => {
      this.$axios
        .get(window.Laravel.base_url + "admin/profile")
        .then((response) => {
          console.log(response);
          this.user = response.data.user;
          this.$Progress.finish();
          this.imagePreview = "/uploads/profile/thumbnail/" + this.user.image;
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
       updateProfile(){
           let formData = new FormData();
           formData.append("image", this.user.image);
          this.$axios
          .post(
            window.Laravel.base_url + "admin/profile/image/" + this.user.id,
            formData
          )
          .then((response) => {
              console.log(response.data);
              this.$swal.fire({
              icon: "success",
              title: "Success !!!",
              text: "Successfully Image Updated",
            });
          })
          .catch((error)=>{
              console.log('error');
          });
      },
      updateDesignation(){
           let formData = new FormData();
           formData.append("designation", this.user.designation);
           formData.append("_method", "PATCH");
          this.$axios
          .post(
            window.Laravel.base_url + "admin/profile/designation/" + this.user.id,
            formData
          )
          .then((response) => {
              console.log(response.data);
              this.$swal.fire({
              icon: "success",
              title: "Success !!!",
              text: "Successfully Designation Updated",
            });
          })
          .catch((error)=>{
              console.log('error');
          });
      },
      updateName(){
           let formData = new FormData();
           formData.append("name", this.user.name);
           formData.append("_method", "PATCH");
          this.$axios
          .post(
            window.Laravel.base_url + "admin/profile/name/" + this.user.id,
            formData
          )
          .then((response) => {
              console.log(response.data);
              this.$swal.fire({
              icon: "success",
              title: "Success !!!",
              text: "Successfully Name Updated",
            });
          })
          .catch((error)=>{
              console.log('error');
          });
      },
      updateEmail(){
           let formData = new FormData();
           formData.append("email", this.user.email);
           formData.append("_method", "PATCH");
          this.$axios
          .post(
            window.Laravel.base_url + "admin/profile/email/" + this.user.id,
            formData
          )
          .then((response) => {
              console.log(response.data);
              this.$swal.fire({
              icon: "success",
              title: "Success !!!",
              text: "Successfully email Updated",
            });
          })
          .catch((error)=>{
              console.log('error');
          });
      },
      updateContact(){
           let formData = new FormData();
           formData.append("contact_no", this.user.contact_no);
           formData.append("_method", "PATCH");
          this.$axios
          .post(
            window.Laravel.base_url + "admin/profile/contact/" + this.user.id,
            formData
          )
          .then((response) => {
              console.log(response.data);
              this.$swal.fire({
              icon: "success",
              title: "Success !!!",
              text: "Successfully contact no Updated",
            });
          })
          .catch((error)=>{
              console.log('error');
          });
      },
     updateAbout(){
           let formData = new FormData();
           formData.append("summary", this.user.summary);
           formData.append("description", this.user.description);
           formData.append("_method", "PATCH");
          this.$axios
          .post(
            window.Laravel.base_url + "admin/profile/about/" + this.user.id,
            formData
          )
          .then((response) => {
              console.log(response.data);
              this.$swal.fire({
              icon: "success",
              title: "Success !!!",
              text: "Successfully About Updated",
            });
          })
          .catch((error)=>{
              console.log('error');
          });
      },
    onFileChange(event) {
      /*
    Set the local file variable to what the user has selected.
    */
      // this.formData.picture = event.target.files[0];
      this.user.image = event.target.files[0];
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
          this.imagePreview = reader.result;
        }.bind(this),
        false
      );

      /*
    Check to see if the file is not empty.
    */
      if (this.user.image) {
        /*
            Ensure the file is an image file.
        */
        if (/\.(jpe?g|png|gif)$/i.test(this.user.image.name)) {
          console.log("here");
          this.showUpload=true;
          /*
            Fire the readAsDataURL method which will read the file in and
            upon completion fire a 'load' event which we will listen to and
            display the image in the preview.
            */
          reader.readAsDataURL(this.user.image);
        }
      }
    },
  },
};
</script>
