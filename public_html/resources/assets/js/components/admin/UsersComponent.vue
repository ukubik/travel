<template lang="html">

  <div class="row">
    <div class="col">
      <div class="table-responsive" v-if="users.length > 0">
        <table class="table table-sm table-bordered">
          <thead class="black white-text text-center">
            <th>№ п/п</th>
            <th>Аватар</th>
            <th>Роль</th>
            <th>Логин</th>
            <th>E-mail</th>
            <th>Зарегистрирован</th>
            <th>Подписка</th>
            <th>Статус</th>
            <th>Действие</th>
          </thead>

          <tbody>
            <tr v-for="(user, index) in users">
              <td class="text-center font-weight-bold">{{ index + 1 }}</td>
              <td>
                <img :src="'/public/storage/' + user.avatar_path" alt="avatar" class="img-fluid" style="max-height: 50px">
              </td>
              <td v-if="user.role_id === 1">Администратор</td>
              <td v-if="user.role_id === 2">Пользователь</td>
              <td v-if="user.role_id === 3">Автор</td>
              <td>{{ user.login }}</td>
              <td>{{ user.email }}</td>
              <td>{{ user.created_at }}</td>
              <td>{{ user.subscription }}</td>
              <td>{{ user.status }}</td>
              <td>
                <button class="btn btn-sm btn-danger waves-effect px-3"
                        data-toggle="tooltip"
                        data-placement="bottom"
                        title="Заблокировать"
                        v-show="user.status === 'Активен'" @click.prevent="blockUser(user.id, 'Блокирован')">
                  <i class="fa fa-ban fa-2x" aria-hidden="true"></i>
                </button>
                <button class="btn btn-sm btn-success waves-effect px-3"
                        data-toggle="tooltip"
                        data-placement="bottom"
                        title="Активировать"
                        v-show="user.status === 'Блокирован'" @click.prevent="blockUser(user.id, 'Активен')">
                  <i class="fa fa-smile-o fa-2x" aria-hidden="true"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</template>

<script>
export default {
  data() {
    return {
      users: [],
    }
  },

  created() {
    this.getUsers();
  },

  methods: {
    getUsers() {
      axios.get('/admin/get-users').then(response => {
        this.users = response.data
      });
    },

    blockUser(id, text) {
      axios.put('/admin/users/' + id, {
        status: text
      }).then(response => {
        this.users = response.data
      });
    },
  }
}
</script>

<style lang="css">
</style>
