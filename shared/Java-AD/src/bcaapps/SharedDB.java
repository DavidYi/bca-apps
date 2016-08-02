package bcaapps;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Types;
import java.util.Properties;

public class SharedDB {
	public static final String USER_TABLE = "user";
	
	private Connection conn = null;

	public SharedDB(String serverName, String port, String userName, String password, String db) throws SQLException {

		Properties connectionProps = new Properties();
		connectionProps.put("user", userName);
		connectionProps.put("password", password);
		connectionProps.put("password", password);

		conn = DriverManager.getConnection("jdbc:mysql://" + serverName + ":" + port + "/" + db, connectionProps);
		
		System.out.println("Connected to database");
	}

	private void inactiveUserType(String userType) throws SQLException {
		PreparedStatement updateStmt = null;
 
		try {
			String updateString = "update " + USER_TABLE + " set usr_active = 0 "
					+ " where usr_ad_allow_updt = 1 and usr_type_cde=?";
			updateStmt = conn.prepareStatement(updateString);
			updateStmt.setString(1, userType);
			updateStmt.executeUpdate();
		} finally {
			if (updateStmt != null) {
				updateStmt.close();
			}
		}
	}

	public void inactiveAllStudents() throws SQLException {
		inactiveUserType("STD");
	}

	public void inactiveAllTeachers() throws SQLException {
		inactiveUserType("TCH");
	}

	public void saveUser(User user) throws SQLException {
		PreparedStatement updateStmt = null;

		String query = "";
		if (user.getUsrId() == null)
			query = "insert into " + USER_TABLE + " (usr_first_name, usr_last_name, usr_display_name, "
					+ "usr_bca_id, user_email, usr_type_cde, usr_class_year, "
					+ "academy_cde, ps_id, usr_ad_cn, usr_active) " + " values (?,?,?,?,?,?,?,?,?,?,?)";
		else
			query = "update " + USER_TABLE + " set usr_first_name = ?, usr_last_name = ?, usr_display_name = ?, "
					+ "usr_bca_id = ?, user_email = ?, usr_type_cde = ?, usr_class_year = ?, "
					+ "academy_cde = ?, ps_id = ?, usr_ad_cn = ?, usr_active = ? " + 
					" where usr_ad_allow_updt = 1 and usr_id = ? ";

		try {
			updateStmt = conn.prepareStatement(query);
			updateStmt.setString(1, user.getUsrFirstName());
			updateStmt.setString(2, user.getUsrLastName());
			updateStmt.setString(3, user.getUsrDisplayName());
			updateStmt.setString(4, user.getUsrBcaId().toLowerCase());
			updateStmt.setString(5, user.getUsrEmail().toLowerCase());
			updateStmt.setString(6, user.getUsrTypeCde());
			if (user.getUsrClassYear() != null)
				updateStmt.setInt(7, user.getUsrClassYear());
			else {
				updateStmt.setNull(7, java.sql.Types.INTEGER);
			}
			updateStmt.setString(8, user.getAcademyCde());
			updateStmt.setString(9, user.getPsId());
			updateStmt.setString(10, user.getUsrAdCn());
			updateStmt.setInt(11, user.getUsrActive());

			if (user.getUsrId() != null)
				updateStmt.setInt(12, user.getUsrId());

			updateStmt.executeUpdate();
		} finally {
			if (updateStmt != null) {
				updateStmt.close();
			}
		}
	}

	public User loadUserByEmail(String emailId) throws SQLException {
		PreparedStatement queryStmt = null;
		ResultSet rs = null;
		User user = null;

		try {
			String queryString = "select * from " + USER_TABLE + " where lower(user_email) = lower(?)";
			queryStmt = conn.prepareStatement(queryString);
			queryStmt.setString(1, emailId);
			rs = queryStmt.executeQuery();
			if (rs.next()) {
				user = new User(rs.getInt("usr_id"), rs.getString("usr_first_name"), rs.getString("usr_last_name"),
						rs.getString("usr_display_name"), rs.getString("usr_bca_id"),
						rs.getString("user_email"), rs.getString("usr_type_cde"), (Integer)rs.getObject("usr_class_year"),
						rs.getString("academy_cde"), rs.getString("ps_id"), rs.getInt("usr_active"),
						rs.getString("usr_ad_cn"));
			}
			return user;

		} finally {
			if (rs != null)
				rs.close();

			if (queryStmt != null) {
				queryStmt.close();
			}
		}
	}

}
