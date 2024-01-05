// vue_app.js
import ('./config.js');

const parentAccount = Vue.createApp({
  data() {
    return {
      server_entry: baseURL,
      account: null,
      child: {
      first_name: '',
      last_name: '',
      date_of_birth: '',
      country: '',
      language: '',
      bio: '',
      username: '',
      password: '',
      profile_picture: '',
      parent_account_id: null
      }
    };
  },
  methods: {
    async getAccountInfo() {      
      const person_id = await this.getAccountID();
  
      if (!person_id) {
        console.error('Person ID is missing.');
        return;
      }
      // Assign person_id to parent_account_id directly
      this.child.parent_account_id = person_id;
  
      fetch(this.server_entry + `account/id/${person_id}/`)
        .then(response => {
          if (!response.ok) {
            throw new Error(`Request failed with status ${response.status}: ${response.statusText}`);
          }
          return response.json();
        })
        .then(data => {
          this.account = data;
        })
        .catch(error => {
          console.error('Error:', error);
        });
    },
    async getAccountID() {
      try {
        const response = await fetch(this.server_entry + 'account/session/');
        if (!response.ok) {
          throw new Error(`Request failed with status ${response.status}: ${response.statusText}`);
        }
        const data = await response.json();
        return data.id;
      } catch (error) {
        console.error('This Error:', error);
      }
    },
    async addChild() {
      try {
        const childData =  this.child ; 
        console.log(childData);
    
        const response = await fetch(this.server_entry + 'user/create/', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(childData)
        });
        
        if (!response.ok) {
          throw new Error(`Request failed with status ${response.status}: ${response.statusText}`);
        }
    
        const data = await response.json(); // Process the response as JSON.
    
        console.log(data);
        // Further process the data as needed.
    
      } catch (error) {
        console.error('Error:', error);
        // Handle the error if needed
      }
    }
    
  },
  mounted() {
    this.getAccountInfo();
  }
});

parentAccount.mount('#parentAccount');

const childAccount = Vue.createApp({
  data() {
    return {
      server_entry: baseURL,
      user: null,
      parentEmail: null
    };
  },
  methods: {
    async getUserInfo() {
      const user_id = await this.getUserID();

      if (!user_id) {
        console.error('User ID is missing.');
        return;
      }
      const response = await fetch(this.server_entry + `user/id/${user_id}/`);
      if (!response.ok) {
        throw new Error(`Request failed with status ${response.status}: ${response.statusText}`);
      }
      const data = await response.json();
      this.user = data;
    },
    async getUserID() {
      try {
        const response = await fetch(this.server_entry + 'user/session/');
        if (!response.ok) {
          throw new Error(`Request failed with status ${response.status}: ${response.statusText}`);
        }
        const data = await response.json();
        return data.id;
      } catch (error) {
        console.error('Error:', error);
      }
    },
    async getParentEmail() {
      console.log("test 1");
      try {
        const response = await fetch(this.server_entry + 'account/id/' + this.user.parent_account_id + '/');
        console.log("test 2");
        if (!response.ok) {
          throw new Error(`Request failed with status ${response.status}: ${response.statusText}`);
        }
        const data = await response.json();
        return data.email; // Return parent email
      } catch (error) {
        console.error('Error:', error);
      }
    },
    async fetchUserData() {
      await this.getUserInfo();
      this.parentEmail = await this.getParentEmail(); // Assign the parent email separately
    },
  },
  mounted() {
    this.fetchUserData();
  }
});

childAccount.mount('#childAccount');


const blogPost = Vue.createApp({
  data() {
    return {
      server_entry: baseURL, 
      hiddenValue: '',
      BlogPostData: {}
    };
  },
  methods: {
    async getAllBlogPosts() {
      fetch(this.server_entry + 'blogpost/list/')
        .then(response => {
          if (!response.ok) {
            throw new Error(`Request failed with status ${response.status}: ${response.statusText}`);
          }
          return response.json();
        })
        .then(data => {
          this.BlogPostData = data;
        })
        .catch(error => {
          console.error('Error:', error);
        });
    },

    async getBlogPostInformation() {
      this.hiddenValue = document.getElementById('hiddenIdBlogValue').value;
      fetch(this.server_entry + `blogpost/id/${this.hiddenValue}/`)
        .then(response => {
          if (!response.ok) {
            throw new Error(`Request failed with status ${response.status}: ${response.statusText}`);
          }
          return response.json();
        })
        .then(data => {
          this.BlogPostData[this.hiddenValue] = data;
        })
        .catch(error => {
          console.error('Error:', error);
        });
    },
  },
  mounted() {
    this.getAllBlogPosts();
  }
});

blogPost.mount('#blogPost');

const createPostApp = Vue.createApp({
  data() {
    return {
      server_entry: baseURL,
      formData: {
        category: '',
        referral_post: '',
        keywords: '',
        post_title: '',
        textarea1: '',
        images: [],
        youtube_url: '',
        vimeo_url: '',
        tiktok_embed_tag: '',
        textarea2: ''
      }
    };
  },
  methods: {
    async submitForm() {
      //NOTE: This is not how the finish project should be handled, everything should be separate
      //First we need to filter the data between story, illustration, enigeer or translator
      
      try {
        const response = await fetch(this.server_entry + 'blogpost/create/', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(this.formData)
        });

        if (!response.ok) {
          throw new Error(`Request failed with status ${response.status}: ${response.statusText}`);
        }

        const data = await response.json(); // Process the response as JSON.

        console.log(data);
        // Further process the data as needed.

      } catch (error) {
        console.error('Error:', error);
        // Handle the error if needed
      }
    }
  }
});

createPostApp.mount('#createPostForm');

