const {EmbedBuilder ,PermissionFlagsBits} = require("discord.js");
const {SlashCommandBuilder} = require('@discordjs/builders');

module.exports = {
   
    data: new SlashCommandBuilder()
    .setName("lock")
    .setDescription("locks a channel")
    .addChannelOption(option =>
         option
         .setName('lockchannel')
         .setDescription('Channel die je wilt locken')
         .setRequired(true))
    .addRoleOption(option => 
        option.setName('lockrole')
        .setDescription("Role voor wie de channel gelocked moet zijn")
        .setRequired(true)
    ),

    async execute(interaction, client) {
        if(!interaction.member.permissions.has(PermissionFlagsBits.Administrator))return await interaction.reply({content: "Jij hebt niet de juiste role om dit te doen"});
        const Channel = interaction.options.getChannel("lockchannel");
        const Role = interaction.options.getRole('lockrole');
        Channel.permissionOverwrites.create(Role,{SendMessages:false});
        const Embed = new EmbedBuilder()
        .setTitle("Channel Locked")
        .setDescription(`Dit channel is gelocked ${Channel} voor deze rol${Role}`)
        .setColor("Green")
        .setFooter({text:"Made by: royboot on discord"})
        interaction.reply({ embeds: [Embed] })
    }
}
