<template>

	<div class="row px-2">
		<div class="col">
			<table class="table table-sm table-bordered z-depth-2">
		    	<col width="60%">
		    	<col width="14%">
		    	<col width="26%">
			  <thead class="black white-text">
			    <tr class="text-center">
			      <th scope="col">Содержание</th>
			      <th scope="col">Время создания</th>
			      <th scope="col">Действие</th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr v-for="comment in comments.data">
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
	data() {
		return {
			comments: {},
		}
	},

	created() {
		this.getResults()
	},

	methods: {
		getResults(page) {
		    if (typeof page === 'undefined') {
		        page = 1;
		    }
        axios.get('get-comments?page=' + page).then(response => {
		        return this.comments = response.data;
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
