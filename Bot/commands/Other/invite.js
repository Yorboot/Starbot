const { SlashCommandBuilder, EmbedBuilder } = require("discord.js")

module.exports = {
    data: new SlashCommandBuilder()
        .setName("invite")
        .setDescription("gives a link to invite the bot to your server"),
    async execute(interaction, client) {
        interaction.reply("https://discord.com/oauth2/authorize?client_id=1244657841445404833&scope=bot&permissions=8")
    }
}
