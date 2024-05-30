const {EmbedBuilder ,PermissionFlagsBits} = require("discord.js");
const {SlashCommandBuilder} = require('@discordjs/builders');


module.exports = {
   
    data: new SlashCommandBuilder()
    .setName("unlock")
    .setDescription("unlocks a channel")
    .addChannelOption(option =>
         option
         .setName('unlockchannel')
         .setDescription('Channel die je wilt unlocken')
         .setRequired(true))
    .addRoleOption(option => 
        option.setName('unlockrole')
        .setDescription("Role voor wie de channel unlocked moet zijn")
        .setRequired(true)
    ),

    async execute(interaction, client) {
        const UnlockChannel = interaction.options.getChannel("unlockchannel")??"Geen Channel Gegeven";
        const UnlockRole = interaction.options.getRole('unlockrole');
        if(!interaction.member.permissions.has(PermissionFlagsBits.Administrator))return await interaction.reply({content: "Jij hebt niet de juiste role om dit te doen"});
        else{
        UnlockChannel.permissionOverwrites.create(UnlockRole,{SendMessages:true});
        const Embed = new EmbedBuilder()
        .setTitle("Channel Unlocked")
        .setDescription(`Dit channel is unlocked ${UnlockChannel} voor deze rol${UnlockRole}`)
        .setColor("Green")
        .setFooter({text:"Made by: royboot on discord"})
        interaction.reply({ embeds: [Embed] })
    }

    }
}
