const { SlashCommandBuilder, EmbedBuilder, PermissionsBitField } = require("discord.js")

module.exports = {
    data: new SlashCommandBuilder()
        .setName("clear")
        .setDescription("Clear a bulk of messages")
        .addIntegerOption(option =>
            option.setName('messagecount')
                .setDescription("The amount of messages to delete")
                .setRequired(true)
        ),
    async execute(interaction, client) {
        try {
            if (!interaction.member.permissions.has(PermissionsBitField.Flags.ManageMessages)) return interaction.reply({ content: "You dont have the permissions to use this command", ephemeral: true })
                let amount = interaction.options.getInteger('messagecount');
        
                interaction.channel.bulkDelete(amount).then(() => {
        
                    if (amount === 0) {
                        interaction.reply("You cannot delete 0 messages").then(msg => msg.delete({ timeout: 1000 }));
                    } else {
                        interaction.reply(`You have ${amount} messages deleted`).then(msg => msg.delete({ timeout: 1000 }));
                    }
        
                })
        } catch (e) {
            console.log(e);
        }
    }
}
