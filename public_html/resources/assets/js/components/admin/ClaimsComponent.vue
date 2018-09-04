<template lang="html">

  <div class="row mb-3">

    <!-- Errors -->
    <transition name="fade">
      <div class="alert alert-danger z-depth-3" v-if="this.errors.length > 0" v-show="showError" id="alert">
        <button type="button" class="close" @click="hiddenErr" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <ul>
            <li v-for="error in this.errors">
                {{ error }}
            </li>
        </ul>
      </div>
    </transition>
    <!-- Messages -->
    <transition name="fade">
      <div class="alert alert-success z-depth-3" v-if="this.messages.length > 0" v-show="showMessage" id="alert">
        <button type="button" class="close" @click="hiddenMessage" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <ul>
            <li v-for="message in this.messages">
                {{ message }}
            </li>
        </ul>
      </div>
    </transition>

    <div class="col">

      <div class="table-responsive" v-if="showTable > 0">
        <table class="table table-sm table-bordered mb-0">
          <thead class="black white-text text-center">
            <!-- <th>Login</th>
            <th>E-mail</th> -->
            <th>Theme</th>
            <th>Description</th>
            <th>Статус</th>
            <th>Action</th>
          </thead>

          <tbody>
            <tr v-for="claim in claims.data">
              <!-- <td>{{ user.login }}</td>
              <td>{{ user.email }}</td> -->
              <td data-toggle="modal" data-target="#basicExampleModal">
                <a href="#" data-toggle="tooltip"
                  data-placement="bottom"
                  title="Посмотреть данные пользователя"
                  class="font-weight-bold blue-text"
                  @click.prevent="getUser(claim.user_id)"> <ins>{{ claim.theme }}</ins>
                </a>
              </td>
              <td>{{ claim.description }}</td>
              <td class="font-weight-bold text-center" v-bind:class="{ 'bg-red': claim.result === 'Отклонена', 'bg-green': claim.result === 'Удовлетворена' }">
                {{ claim.result }}
              </td>
              <td class="text-center">
                <button class="btn btn-success px-3" v-if="claim.result === 'Рассматривается' || claim.result === 'Отклонена'"
                        data-toggle="tooltip"
                        data-placement="bottom"
                        title="Удовлетворить" @click.prevent="updateClaim(claim.id, 'Удовлетворена')">
                  <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                </button>
                <button class="btn btn-danger px-3"
                        data-toggle="tooltip" data-placement="bottom"
                        title="Отклонить"
                        v-if="claim.result === 'Рассматривается' || claim.result === 'Удовлетворена'"
                        @click.prevent="updateClaim(claim.id, 'Отклонена')">
                  <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
        <pagination :data="claims" v-on:pagination-change-page="getResults" class="my-3"></pagination>
      </div>

      <div class="alert alert-dark" v-else>
        <p>Заявки не обнаружены...</p>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Пользователь {{ user.login }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Email: {{ user.email }}</p>
              <p>Зарегистрирован: {{ user.created_at }}</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-pink" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

</template>

<script>
  export default {
    data() {
      return {
        claims: [],
        user: {},
        showTable: 0,
        showError: false,
        errors: [],
        showMessage: true,
        messages: []
      }
    },

    created() {
  		this.getResults();
  	},

    methods: {
      getResults(page) {
          if (typeof page === 'undefined') {
              page = 1;
          }
          axios.get('/admin/get-claims?page=' + page).then(response => {
            this.showTable = response.data.data.length;
            // console.log(response.data);
            return this.claims = response.data;
        });
      },

      getUser(id) {
        axios.get('/admin/users/' + id).then(response => {
          this.user = response.data;
        });
      },

      updateClaim(id, result) {
        axios.put('/admin/claims/' +id, {
          result: result
        }).then(response => {
          this.getResults();
        }).catch(error => {
          this.showError = true;
          this.errors = _.flatten(_.toArray(error.response.data.errors));
          this.hiddenTimeOutErr();
        });
      },

      //скрытие окна ошибки
      hiddenErr() {
        this.showError = false;
      },
      hiddenTimeOutErr() {
        setTimeout(() => {
          this.showError = false;
        }, 5000);
      },
      //скрытие окна уведомления
      hiddenMessage() {
        this.showMessage = false;
      },
      hiddenTimeOutMess() {
        setTimeout(() => {
          this.showMessage = false;
        }, 5000);
      },

    }
  }
</script>

<style media="screen">

</style>
