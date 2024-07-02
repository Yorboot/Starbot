const { SlashCommandBuilder, EmbedBuilder } = require("discord.js")

module.exports = {
    data: new SlashCommandBuilder()
        .setName("roleinfo")
        .setDescription("gives info about a role")
        .addRoleOption(option => option.setName('targetrole').setDescription('set '))
    async execute(interaction, client) {
        const Embed = new EmbedBuilder()
            .setTitle("Bot Ping")
            .setDescription(`${client.ws.ping}ms`)
            .setColor("White")

        interaction.reply({ embeds: [Embed] })
    }
}
