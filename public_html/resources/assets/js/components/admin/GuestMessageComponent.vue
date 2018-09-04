<template lang="html">

  <div class="container">
    <div class="row mt-4">
      <div class="col text-center">
        <h3>Гостевые сообщения</h3>
      </div>
    </div>

    <div class="row my-3" v-if="showTable > 0">
      <div class="col d-flex justify-content-end">
        <button class="btn btn-danger waves-effect border" @click.prevent="destroyAll">удалить все</button>
      </div>
    </div>

    <div class="row my-3" v-if="showTable > 0">
      <div class="col">
        <table class="table table-sm table-bordered z-depth-2">
          <thead class="text-center bg-dark white-text">
            <th>Имя гостя</th>
            <th>Email</th>
            <th>Содержание сообщения</th>
            <th>Время создания</th>
            <th>Действие</th>
          </thead>
          <tbody>
            <tr v-for="message in messages.data">
              <td>{{ message.name }}</td>
              <td>{{ message.email }}</td>
              <td>{{ message.message }}</td>
              <td>{{ message.created_at }}</td>
              <td>
                <button class="btn btn-sm btn-danger border" @click.prevent="destroyMessage(message.id)">удалить</button>
              </td>
            </tr>
          </tbody>
        </table>
        <pagination :data="messages" v-on:pagination-change-page="getResults"></pagination>
      </div>
    </div>


    <div class="row mt-5 pt-5" v-else>
      <div class="col">
        <div class="alert alert-dark">
          Сообщения не найдены...
        </div>
      </div>
    </div>

  </div>

</template>

<script>
export default {
  data() {
		return {
			messages: {},
      showTable: 0
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
        axios.get('get-messages?page=' + page).then(response => {
          this.showTable = response.data.data.length;
	        return this.messages = response.data;
	    });
		},

    destroyMessage(id) {
      axios.delete('/admin/guestmessage/' + id).then(response => {
        this.getResults();
      });
    },

    destroyAll() {
      axios.delete('/admin/destroy-all').then(response => {
        this.getResults();
      });
    }
	},
}
</script>

<style lang="css">
.pagination .page-item.active .page-link {
	background-color: red;
}
</style>
