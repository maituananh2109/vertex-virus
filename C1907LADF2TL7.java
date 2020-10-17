/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package c1907l.adf2.tl7;
import com.sun.rowset.RowSetFactoryImpl;
import java.sql.CallableStatement;
import java.sql.Connection;
import java.sql.DatabaseMetaData;
import java.sql.Driver;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.sql.RowSet;


/**
 *
 * @author FHP
 */
public class C1907LADF2TL7 {
    public static final String DB = "c1907l";
    public static final String URL = "jdbc:mysql://localhost:3306/" + DB+"?serverTimezone=UTC";
    public static final String USER = "admin";
    public static final String PASS = "1234";
    
    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        try {
            // TODO code application logic here
            Connection connection = DriverManager.getConnection(URL, USER, PASS);
            DatabaseMetaData metaData = connection.getMetaData();
            System.out.println(metaData.getDatabaseProductName());

            Statement createStatement = connection.createStatement(ResultSet.TYPE_SCROLL_SENSITIVE, ResultSet.CONCUR_UPDATABLE);
            boolean execute = createStatement.execute("select * from student");
            if(execute){
                ResultSet resultSet = createStatement.getResultSet();
                while(resultSet.next()){
                    printData(resultSet);                    
                }
                System.out.println("================");
                resultSet.absolute(1);//point = point
                printData(resultSet);
                resultSet.relative(2);//point = point + 2
                printData(resultSet);
                resultSet.updateString("Name", "13 updated");
                resultSet.updateRow();
                resultSet.moveToInsertRow();
                resultSet.updateString("Name", "insert");
                resultSet.updateString("Email", "insert@gmail.com");
                resultSet.updateString("Gender", "male");
                resultSet.insertRow();
                
            } 
            //B1
            connection.setAutoCommit(false);
            //B2
            PreparedStatement insert = connection.prepareStatement("insert into student(Name, Email, Gender) values (?,?,?)");
            //B3
            insert.setString(1, "Name 1");
            insert.setString(2, "Name1@gmail.com");
            insert.setString(3, "Male");
            insert.addBatch();
            insert.setString(1, "Name 2");
            insert.setString(2, "Name2@gmail.com");
            insert.setString(3, "Male");
            insert.addBatch();
            insert.setString(1, "Name 3");
            insert.setString(2, "Name3@gmail.com");
            insert.setString(3, "Male"); 
            insert.addBatch();
            //B4
            insert.executeBatch();
            //B5
            connection.commit();
            //b6
            connection.close();
            
        } catch (SQLException ex) {
            Logger.getLogger(C1907LADF2TL7.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    private static void printData(ResultSet resultSet) throws SQLException {
        String name = resultSet.getString("Name");
        System.out.println(name);
    }
}
