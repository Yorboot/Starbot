const {ActivityType} = require(`discord.js`);
module.exports = {
    name: 'ready',
    once: true,
    async execute(client) {
        console.log('Ready!');
            client.user.setActivity(`cookie`,{ type:ActivityType.Watching, url:'https://www.youtube.com/channel/UCLIzX_R78UUuEhKx9qyXbYQ'});
            console.log("Sucess");
    },
};