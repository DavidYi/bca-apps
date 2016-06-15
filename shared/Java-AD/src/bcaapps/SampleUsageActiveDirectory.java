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
import java.util.Scanner;

import javax.naming.NamingEnumeration;
import javax.naming.NamingException;
import javax.naming.directory.Attributes;
import javax.naming.directory.SearchResult;

/**
 * Sample program how to use ActiveDirectory class in Java
 * 
 * @filename SampleUsageActiveDirectory.java
 * @author <a href="mailto:jeeva@myjeeva.com">Jeevanandam Madanagopal</a>
 * @copyright &copy; 2010-2012 www.myjeeva.com
 */
public class SampleUsageActiveDirectory {

	/**
	 * @param args
	 * @throws NamingException 
	 */
	public static void main(String[] args) throws NamingException, IOException {
		Scanner input = new Scanner(System.in);
		System.out.println("\n\nQuerying Active Directory Using Java");
		System.out.println("------------------------------------");
		String choice = "";
		String searchTerm = "";
		System.out.println("Enter password for bryres");
		String pw = input.nextLine();
		
		//Creating instance of ActiveDirectory
        ActiveDirectory activeDirectory = new ActiveDirectory(pw);
        
        //Searching
        NamingEnumeration<SearchResult> result = activeDirectory.searchUser(searchTerm, choice, null);
        
        while(result.hasMore()) {
			SearchResult rs= (SearchResult)result.next();
			Attributes attrs = rs.getAttributes();
			String temp = attrs.get("samaccountname").toString();
			System.out.println("Username	: " + temp.substring(temp.indexOf(":")+1));
			temp = attrs.get("givenname").toString();
			System.out.println("First Name         : " + temp.substring(temp.indexOf(":")+1));
			temp = attrs.get("sn").toString();
			System.out.println("Last Name         : " + temp.substring(temp.indexOf(":")+1));
			temp = attrs.get("mail").toString();
			System.out.println("Email ID	: " + temp.substring(temp.indexOf(":")+1));
			temp = attrs.get("cn").toString();
			System.out.println("Display Name : " + temp.substring(temp.indexOf(":")+1) + "\n\n"); 
		} 
		System.out.println("Search Complete!");

		//Closing LDAP Connection
        activeDirectory.closeLdapConnection();
	}
}
