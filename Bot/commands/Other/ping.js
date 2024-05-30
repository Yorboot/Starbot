const { SlashCommandBuilder, EmbedBuilder } = require("discord.js")

module.exports = {
    data: new SlashCommandBuilder()
    .setName("ping")
    .setDescription("Get the bots Ping"), 
    async execute(interaction, client) {
        const Embed = new EmbedBuilder()
        .setTitle("Bot Ping")
        .setDescription(`${client.ws.ping}ms`)
        .setColor("White")

        interaction.reply({ embeds: [Embed] })
    }
}
