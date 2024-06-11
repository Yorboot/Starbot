const { SlashCommandBuilder, EmbedBuilder,Client } = require("discord.js")
const fs = require('node:fs');
const { url } = require("node:inspector");
const ytdl = require('ytdl-core');

module.exports = {
    data: new SlashCommandBuilder()
    .setName("play")
    .setDescription("joins a vc and plays a song")
    .addStringOption(option => option.setName('songurl').setDescription('url of song to play').setRequired(true))
    .addChannelOption(option => option.setName('joinchannel').setDescription('This is the channel the bot will join')),
    async execute(interaction,client){
        try {
            let Songurl = interaction.options.getString('songurl');
            if (!interaction.member.voice.channel) return interaction.reply("Conect to a vc")
                if (client.voice.channel) return interaction.reply("The bot is already in a channel");
                var validate = await ytdl.validateURL(url);
                if (!validate) return interaction.reply("Please give a valid url")
                
                var info = await ytdl.getInfo(Songurl);
                var options = { seek: 3, volume: 1 };
                var channelJoin = await interaction.member.voice.channel.join()
                    .then(voiceChannel => {
            
                        var stream = ytdl(args[0], { filter: 'audioonly' });
                        var dispatcher = voiceChannel.play(stream, options);
            
                    }).catch(console.error);
                message.channel.send(`Now playing ${info.title}`);
        } catch (e) {
            console.log(e);
        }
        const FinalEmbed = new EmbedBuilder()
                    .setColor('Aqua')
                    .setDescription(`${Songurl} is the song now playing`)
                    .setFooter(`${interaction.message.createdAt}`)
        interaction.reply({ embeds: [FinalEmbed] })
    }
}
