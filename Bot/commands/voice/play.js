const { SlashCommandBuilder, EmbedBuilder,Client } = require("discord.js")
const fs = require('node:fs');

module.exports = {
    data: new SlashCommandBuilder()
    .setName("play")
    .setDescription("joins a vc and plays a song")
    .addStringOption(option => option.setName('songurl').setDescription('url of song to play').setRequired(true))
    .addChannelOption(option => option.setName('joinchannel').setDescription('This is the channel the bot will join')),
    async execute(interaction, client) {
            interaction.reply({ embeds: [FinalEmbed] })
    }
}
