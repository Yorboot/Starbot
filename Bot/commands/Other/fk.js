const { SlashCommandBuilder, EmbedBuilder } = require("discord.js")

module.exports = {
    data: new SlashCommandBuilder()
    .setName("pong")
    .setDescription("Get the bots Pong"), 
    async execute(interaction, client) {
        const Embed = new EmbedBuilder()
        .setTitle("Bot Pong")
        .setDescription(`${client.ws.ping}ms`)
        .setColor("White")

        interaction.reply({ embeds: [Embed] })
    }
}
