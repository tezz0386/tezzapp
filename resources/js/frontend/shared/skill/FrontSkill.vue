<template>
  <div>
    <h6>
      <u>Skill</u>
    </h6>
    <div class="skill-mf mb-2">
      <span>PHP</span> <span class="pull-right">80%</span>
      <div class="progress my-progressbar">
        <div
          class="progress-bar"
          role="progressbar"
          style="width: 80%"
          aria-valuenow="80"
          aria-valuemin="0"
          aria-valuemax="100"
        ></div>
      </div>

    </div>
  </div>
</template>
<script>
export default {
    data(){
        return{
            skills:{},
        }
    },
    created(){
        this.$axios
        .get(window.Laravel.base_url + "skills")
        .then((response) => {
          console.log(response)
          this.skills = response.data.skills;
          console.log(response.data.message);
        })
        .catch((error) => {
          console.log(error);
        });
    }
}
</script>