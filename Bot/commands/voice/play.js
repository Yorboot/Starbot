const { SlashCommandBuilder, EmbedBuilder } = require("discord.js")


module.exports = {
    data: new SlashCommandBuilder()
    .setName("play")
    .setDescription("joins a vc and plays a song")
    .addStringOption(option => option.setName('songname').setDescription('Title of the song to play'))
    .addChannelOption(option => option.setName('joinchannel').setDescription('This is the channel the bot will join')),
    async execute(interaction){
        
        const Embed = new EmbedBuilder()
        .setTitle("Bot Ping")
        .setDescription("hi")
        .setColor("White")

        interaction.reply({ embeds: [Embed] })
    }
}
