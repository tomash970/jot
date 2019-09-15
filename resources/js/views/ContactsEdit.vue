<template>
	<div>
		<div class="flex justify-between">
			<a href="#" class="text-blue-400" @click="$router.back()">
				< Back
			</a>
		</div>
		<form @submit.prevent="submitForm">
			<InputField name="name" :errors="errors" label="Contact Name" @update:field="form.name = $event" placeholder="Contact Name" :data="form.name"/>
			<InputField name="email" :errors="errors" label="Contact Email" @update:field="form.email = $event" placeholder="Contact Email" :data="form.email"/>
			<InputField name="company" :errors="errors" label="Company" @update:field="form.company = $event" placeholder="Company" :data="form.company"/>
			<InputField name="birthday" :errors="errors" label="Birthday" @update:field="form.birthday = $event" placeholder="DD.MM.YYYY" :data="form.birthday"/>
			<div class="flex justify-end">
				<button class="py-2 px-4 rounded text-red-700 border mr-5 hover:border-red-700">Cancel</button>
				<button class="bg-blue-500 py-2 px-4 text-white rounded hover:bg-blue-400">Save Changes</button>
			</div>

		</form>
	</div>
</template>

<script>
	import InputField from '../components/InputField';

	export default {
		name: "ContactsEdit",
		components: {
			InputField
		},
		mounted(){
			
				axios.get('/api/contacts/' + this.$route.params.id)
				.then(response => {
					console.log('Axios get mounted: ' + JSON.stringify(response.data.data));
					this.form = response.data.data;
					this.loading = false;
				})
				.catch(error => {
					
					this.loading = false;
					if (error.response.status === 404) {
						this.$router.push('/contacts');
					}
				});
			
		},
		data: function() {
			return {
				form: {
					'name' : '',
					'email' : '',
					'company' : '',
					'birthday' : '',
				},
				errors: null,
			}
		},
		methods: {
			submitForm: function () {
				console.log('Update form data: ' + JSON.stringify(this.form));
				axios.patch('/api/contacts/' + this.$route.params.id, this.form)
				.then(response => {

					this.$router.push(response.data.links.self);
				})
				.catch(errors => {
					this.errors = errors.response.data.errors;
					console.log('Update contact error: ' + errors);
				});
			}
		},
		
	}
</script>

<style>
</style>