<template>
	<div>
		<form @submit.prevent="submitForm">
			<InputField name="name" :errors="errors" label="Contact Name" @update:field="form.name = $event" placeholder="Contact Name"/>
			<InputField name="email" :errors="errors" label="Contact Email" @update:field="form.email = $event" placeholder="Contact Email"/>
			<InputField name="company" :errors="errors" label="Company" @update:field="form.company = $event" placeholder="Company"/>
			<InputField name="birthday" :errors="errors" label="Birthday" @update:field="form.birthday = $event" placeholder="DD.MM.YYYY"/>
			<div class="flex justify-end">
				<button class="py-2 px-4 rounded text-red-700 border mr-5 hover:border-red-700">Cancel</button>
				<button class="bg-blue-500 py-2 px-4 text-white rounded hover:bg-blue-400">Add New contact</button>
			</div>

		</form>
	</div>
</template>

<script>
	import InputField from '../components/InputField';

	export default {
		name: "ContactsCreate",
		components: {
			InputField
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
				axios.post('/api/contacts', this.form)
				.then(response => {
					this.$router.push(response.data.links.self);
				})
				.catch(errors => {
					this.errors = errors.response.data.errors
				});
			}
		}
	}
</script>

<style>
</style>