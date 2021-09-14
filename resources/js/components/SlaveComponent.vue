<template>
    <div class="card-deck">
      <h1>{{ message }}</h1>
    </div>
</template>

<script>
    import {db} from '../db.js'

    export default {
        props:['slave'],
        
        data() {
            return {
              message: '',
              someSound
            }
        },
        created()
        {
            this.slavesListener()
        },

        mounted() {
        },

        methods: {

            slavesListener()
            {

                const todosRef = db.ref('sentSignals/'+this.slave)

                todosRef.on('child_added', snapshot => {

                    this.message = snapshot.val().pauseMsg

                    $('body').css({"backgroundColor":snapshot.val().colorCode});

                })

            },

        }
    }
</script>
