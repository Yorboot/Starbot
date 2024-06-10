const { SlashCommandBuilder, EmbedBuilder, } = require("discord.js")

module.exports = {
    data: new SlashCommandBuilder()
    .setName("serverinfo")
    .setDescription("Displays some server info"), 
    async execute(interaction, client) {
        const { guild } = interaction;
        const Embed = new EmbedBuilder()
            .setTitle("ServerInfo")
            .setAuthor({
                name: "royboot", iconURL: 'https://avatars.githubusercontent.com/u/67387670?v=4', url: 'https://github.com/Roy123132123'
            })
            .setDescription(`This is ${guild.name}`)
            .setThumbnail(guild.iconURL({size:256}))
            .addFields({
                name: "Owner",
                value: (await guild.fetchOwner()).user.tag,
                inline: true,
            }, {
                name: "MemberCount",
                value: guild.memberCount.toString(),
                inline: true
            },
                {
                    name: "RoleCount",
                    value:`${guild.roles.cache.size}` ,
                    inline:true,
                },
                {
                    name: "Bot count",
                    value: `${guild.members.cache.filter(member => !member.user.bot).size}`,
                    inline:true
            })
            .setColor("White")
            .setFooter({ text:`Id:${guild.id} | Created at ${guild.createdAt.toDateString()}`})

        interaction.reply({ embeds: [Embed] })
    }
}
