
<template>
	<div>
	    You are logged in!

    <hr>

    <h2>Write something to all users</h2>
    <input type="text" class="form-control" placeholder="something" required="required" v-model="newMsg" @keyup.enter="press">

    <hr>
    <h3>Messages</h3>

    <ul v-for="post in posts">
    <b>@{{ post.username }} says:</b> @{{ post.message }}</li>
    </ul>

	</div>
</template>
<script>
	export default{
    data() {
        return {
            posts: [],
            newMsg: '',

        }
    },


    ready() {
        Echo.channel('public-test-channel')
            .listen('ChatMessageWasReceived', (data) => {

                // Push ata to posts list.
                this.posts.push({
                    message: data.chatMessage.message,
                    username: data.user.name
                });
            });
    },

    methods: {

        press() {

            // Send message to backend.
            this.$http.post('/message/', {message: this.newMsg})
                .then((response) => {

                    // Clear input field.
                    this.newMsg = '';
                });
        },
		
		click() {
		
			this.$http.get('/chat').then((r)={})
		}
		
    	}
	}
</script>