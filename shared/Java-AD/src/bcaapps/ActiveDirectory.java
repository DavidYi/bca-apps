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

import java.util.Properties;
import java.util.logging.Logger;

import javax.naming.Context;
import javax.naming.NamingEnumeration;
import javax.naming.NamingException;
import javax.naming.directory.DirContext;
import javax.naming.directory.InitialDirContext;
import javax.naming.directory.SearchControls;
import javax.naming.directory.SearchResult;

/**
 * Query Active Directory using Java
 * 
 * @filename ActiveDirectory.java
 * @author <a href="mailto:jeeva@myjeeva.com">Jeevanandam Madanagopal</a>
 * @copyright &copy; 2010-2012 www.myjeeva.com
 */
public class ActiveDirectory {
	// Logger
	private static final Logger LOG = Logger.getLogger(ActiveDirectory.class.getName());

    //required private variables   
    private Properties properties;
    protected DirContext dirContext;
    protected SearchControls searchCtls;
	private String[] returnAttributes = { "sAMAccountName", "givenName", "sn", "cn", "mail","name","description" };
	
    /**
     * constructor with parameter for initializing a LDAP context
     * 
     * @param username a {@link java.lang.String} object - username to establish a LDAP connection
     * @param password a {@link java.lang.String} object - password to establish a LDAP connection
     * @param domainController a {@link java.lang.String} object - domain controller name for LDAP connection
     */
    public ActiveDirectory(String password) {
        properties = new Properties();        

        properties.put(Context.INITIAL_CONTEXT_FACTORY, "com.sun.jndi.ldap.LdapCtxFactory");
        properties.put(Context.PROVIDER_URL, "LDAP://168.229.1.240:3268");
        properties.put(Context.SECURITY_PRINCIPAL, "bryres@bergen.org");
        properties.put(Context.SECURITY_CREDENTIALS, password);
        properties.put(Context.REFERRAL, "follow");
        
        //initializing active directory LDAP connection
        try {
			dirContext = new InitialDirContext(properties);
		} catch (NamingException e) {
			LOG.severe(e.getMessage());
		}
        System.out.println(dirContext);
        
        //initializing search controls
        searchCtls = new SearchControls();
        searchCtls.setReturningAttributes(returnAttributes);
    }
    

    /**
     * closes the LDAP connection with Domain controller
     */
    public void closeLdapConnection(){
        try {
            if(dirContext != null)
                dirContext.close();
        }
        catch (NamingException e) {
        	LOG.severe(e.getMessage());            
        }
    }
    
}
