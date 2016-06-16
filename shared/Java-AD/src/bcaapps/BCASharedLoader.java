/**
 * The MIT License
 *
 * Copyright (c) 2010-2012 www.myjeeva.com
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE. 
 * 
 */
package bcaapps;

import java.io.IOException;
import java.sql.SQLException;
import java.util.Scanner;

import javax.naming.NamingEnumeration;
import javax.naming.NamingException;
import javax.naming.directory.Attributes;
import javax.naming.directory.SearchControls;
import javax.naming.directory.SearchResult;

/**
 * Sample program how to use ActiveDirectory class in Java
 * 
 * @filename SampleUsageActiveDirectory.java
 * @author <a href="mailto:jeeva@myjeeva.com">Jeevanandam Madanagopal</a>
 * @copyright &copy; 2010-2012 www.myjeeva.com
 */
public class BCASharedLoader {

	public static String getStrField(Attributes attrs, String fieldName) {
		String temp = attrs.get(fieldName).toString();
		return temp.substring(temp.indexOf(":") + 1).trim();
	}

	public static void updateStudentList(ActiveDirectory ad, SharedDB db) throws NamingException, SQLException {
		ad.searchCtls.setSearchScope(SearchControls.SUBTREE_SCOPE);
		
		/*
		mail=* requires that the user have an email address.  (Otherwise, this account probably is not a student.)
		
		description=* requires that the user have a description.  For students, the description includes 
		the academy and class year.  Absence of this field implies that this is not a user.
		
		sn=* requires that the user have a last name defined.
		*/
		
		String filter = "(&(&(&(objectClass=organizationalPerson)(mail=*))(description=*))(sn=*))";
		
		String base = "OU=Students,DC=bca,DC=bergen,DC=org";

		System.out.println("Loading Students...");
		db.inactiveAllStudents();
		saveActiveDirectoryRowResult(db, ad.dirContext.search(base, filter, ad.searchCtls), true);
	}

	public static void updateTeacherList(ActiveDirectory ad, SharedDB db) throws NamingException, SQLException {
		ad.searchCtls.setSearchScope(SearchControls.ONELEVEL_SCOPE);
		String filter = "(&((&(objectCategory=Person)(objectClass=organizationalPerson)))"
				+ "(company=BERGEN COUNTY TECHNICAL SCHOOLS))";
		String base = "OU=Teachers,DC=bca,DC=bergen,DC=org";

		System.out.println("Loading Teachers...");
		db.inactiveAllTeachers();
		saveActiveDirectoryRowResult(db, ad.dirContext.search(base, filter, ad.searchCtls), false);
	}

	public static void saveActiveDirectoryRowResult(SharedDB db, NamingEnumeration<SearchResult> result, boolean student)
			throws NamingException, SQLException {

		User u = null;
		Attributes attrs = null;
		while (result.hasMore()) {
			try {
				SearchResult rs = (SearchResult) result.next();
				attrs = rs.getAttributes();
	
				
				String email = getStrField(attrs, "mail");
				u = db.loadUserByEmail(email);
	
				// Inserting
				if (u == null) {
					u = new User();
					
					u.setUsrEmail(email);
					
					if (student) 
						u.setUsrTypeCde("STD");
					else {
						u.setUsrTypeCde("TCH");
					}
				}
	
				u.setUsrLastName(getStrField(attrs, "sn"));
				u.setUsrFirstName(getStrField(attrs, "givenname"));
				u.setUsrDisplayName(getStrField(attrs, "name"));
				u.setUsrBcaId(getStrField(attrs, "samaccountname"));
				
				if (student) {
					String description = getStrField(attrs, "description");
					
					// Make sure it contains the student's class year, otherwise, it is a bogus account
					if (!description.contains("20")) {
						System.out.println("No class year, skipping: " + attrs);
						continue;
					}
					int classYear = Integer.parseInt(description.substring(description.indexOf("2")));
					String academy = description.substring(0, description.indexOf("2"));
	
					u.setUsrClassYear(classYear);
					u.setAcademyCde(academy);
				}
				
				u.setUsrAdCn(getStrField(attrs, "cn"));
	
				u.setUsrActive(1);
				db.saveUser(u);
			}
			catch (Exception e) {
				System.err.println("User: " + u);
				System.err.println("AD: " + attrs);
				e.printStackTrace();
			}
		}
	}

	/**
	 * @param args
	 * @throws NamingException
	 */
	public static void main(String[] args) throws NamingException, IOException, SQLException {
		Scanner input = new Scanner(System.in);

		//
		// Development server credentials
		//
		String dbServer = "webdev01.bergen.org";
		String dbPort = "3306";
		String dbUser = "atcsdevb_shrusr";

		System.out.println("Update 'dev' or 'prod'?");
		String environment = input.nextLine();
		
		if (environment.equals("prod")) {
			dbServer = "cpanel01.bergen.org";
			dbPort = "3306";
			dbUser = "bryres_shrusr";
		}
		
		System.out.println("\nEnter password for " +dbUser + "@" +  dbServer);
		String dbPassword = input.nextLine();

		System.out.println("Enter bergen password for bryres");
		String adPw = input.nextLine();

		// Creating instance of ActiveDirectory
		SharedDB db = new SharedDB(dbServer, dbPort, dbUser, dbPassword);
		ActiveDirectory activeDirectory = new ActiveDirectory(adPw);

		updateStudentList(activeDirectory, db);
		updateTeacherList(activeDirectory, db);

		// Closing LDAP Connection
		activeDirectory.closeLdapConnection();
		
		System.out.println("Exiting");
	}
}
