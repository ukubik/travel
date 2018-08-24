<template>

	<div class="row px-2">
		<div class="col">
			<table class="table table-sm table-bordered z-depth-2">
				<col width="15%">
		    	<col width="15%">
		    	<col width="28%">
		    	<col width="15%">
		    	<col width="27%">
			  <thead class="black white-text">
			    <tr class="text-center">
			      <th scope="col">Статья</th>
			      <th scope="col">Логин / E-mail</th>
			      <th scope="col">Содержание</th>
			      <th scope="col">Время создания</th>
			      <th scope="col">Действие</th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr v-for="comment in comments.data">
			      <th scope="row" v-bind="getArticle(comment.article_id)"></th>
			      <td v-bind="getUser(comment.user_id)">{{ user.login }} / {{ user.email }} </td>
			      <td>
			      	<textarea rows="2" class="form-control form-control-sm" v-model="comment.content"></textarea>
			      </td>
			      <td>{{ comment.created_at }}</td>
			      <td>
			      	<button class="btn btn-sm btn-success waves-effect" v-if="comment.published === 'Не опубликован'">Опубликовать</button>
					<button class="btn btn-sm btn-success waves-effect" v-if="comment.published === 'Опубликован'">снять с публикации</button>
					<button class="btn btn-sm btn-warning waves-effect">изменить</button>
					<button class="btn btn-sm btn-danger waves-effect">удалить</button>
			      </td>
			    </tr>

			  </tbody>
			</table>
			<pagination :data="comments" v-on:pagination-change-page="getResults"></pagination>
		</div>
	</div>

</template>

<script>
export default {
	props: [
		
	],

	data() {
		return {
			comments: {},
			user: {},
			article: {}
		}
	},

	mounted() {
		
	},

	created() {
		this.getResults() 
	},

	methods: {
		getResults(page) {
		    if (typeof page === 'undefined') {
		        page = 1;
		    }

            axios.get('get-comment?page=' + page).then(response => {
		        this.comments = response.data;
		        console.log(this.comments)
		    });
		},

		getUser(id) {
			axios.get('get-user/' + id).then(response => {
				return this.user = response.data;
			});
		},

		getArticle(id) {
			axios.get('get-article/' + id).then(response => {
				return this.user = response.data;
			});
		},

	},

}

</script>

<style lang="css">
.pagination .page-item.active .page-link {
	color: red;
}
</style>