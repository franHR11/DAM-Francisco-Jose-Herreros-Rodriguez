import Sequelize from 'sequelize';

const db = new Sequelize('agenciaviajes','franhr','franhr',{
    host: '127.0.0.1',
    port: '3306',
    dialect: 'mysql',
    define: {
        timestamps: false
    },
    pool: {
        max: 5,
        min: 0,
        acquire: 30000,
        idle: 10000
    },
    operatorAlias: false

});

export default db

