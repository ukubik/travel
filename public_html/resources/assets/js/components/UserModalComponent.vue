<template lang="html">
  <!-- Frame Modal Bottom -->
<div class="modal fade top" id="userModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <!-- Add class .modal-frame and then add class .modal-top (or other classes from list above) to set a position to the modal -->
    <div class="modal-dialog modal-frame modal-top" role="document">


      <div class="modal-content">
        <div class="modal-body">
          <div class="row d-flex justify-content-center align-items-center">

              <div class="col-md-3 my-2 border-bottom text-center">
                <i class="fa fa-pencil-square-o fa-3x" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Добавить статью ( в разработке... )"></i>
              </div>
              <div class="col-md-7 my-2 border-bottom text-center">
                <div class="row">
                  <div class="col">
                    <h5>{{ user.login }}</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <a href="/admin" v-if="role === 'Администратор'" data-toggle="tooltip" data-placement="bottom" title="Перейти в админку"><span class="red-text">{{ role }}</span></a>
                    <span class="text-muted" v-else>{{ role }}</span>
                  </div>
                </div>
              </div>
              <div class="col-md-1 my-2 border-bottom text-center">
                <a href="#" class="black-text" data-toggle="modal" data-target="#editProfile" @click="closeUserModal">
                  <i class="fa fa-cogs fa-3x" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Редактировать профиль"></i>
                </a>
              </div>

            <div class="col-md-1 my-2 border-bottom d-flex fustify-content-end">
              <button type="button" class="btn btn-outline-elegant" data-dismiss="modal">закрыть</button>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Frame Modal Bottom -->
</template>

<script>
export default {
  data() {
    return {
      user: {},
      role: '',
    }
  },

  created() {
    this.getUser();
    this.getRole();
  },

  methods: {
    getUser() {
      axios.get('/user/get-user').then(response => {
        this.user = response.data;
      });
    },
    getRole() {
      axios.get('/user/get-role').then(response => {
        this.role = response.data;
      });
    },

    closeUserModal() {
      $('#userModal').modal('hide');
    }
  }
}
</script>

<style lang="css">
</style>
