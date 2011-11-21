//
//  PhotoViewController.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import "PhotoViewController.h"
#import "iRankAppDelegate.h"
#import "Constants.h"

@implementation PhotoViewController
@synthesize webView;
@synthesize eventId, lastEventId;

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        // Custom initialization
    }
    return self;
}

- (void)didReceiveMemoryWarning
{
    // Releases the view if it doesn't have a superview.
    [super didReceiveMemoryWarning];
    
    // Release any cached data, images, etc that aren't in use.
}

#pragma mark - View lifecycle

-(void)viewWillAppear:(BOOL)animated {
    
    [self setTitle:@"Fotos"];
    
    if( eventId!=lastEventId ){
        
        [webView loadHTMLString:@"" baseURL:nil];
        lastEventId = eventId;
        
        [self doRefreshWebView:YES];
    }
}

-(void)viewDidDisappear:(BOOL)animated {
    
    
}

-(void)viewDidAppear:(BOOL)animated {
    
    [super viewDidAppear:animated];
}

-(void)viewWillDisappear:(BOOL)animated {
    
}

- (void)viewDidLoad
{
    [super viewDidLoad];
    
    //    UIBarButtonItem *refreshButton = [[UIBarButtonItem alloc] initWithTitle:@"Atualizar" style:UIBarButtonItemStyleBordered target:self action:@selector(refreshWebView:)];
    
    activityIndicator = [[UIActivityIndicatorView alloc] initWithActivityIndicatorStyle:UIActivityIndicatorViewStyleWhite];
    [activityIndicator setHidesWhenStopped:YES];
    [activityIndicator setHidden:YES];
    
//    UIBarButtonItem * barButton =  [[UIBarButtonItem alloc] initWithCustomView:activityIndicator];
    
    UIBarButtonItem *refreshButton = [[UIBarButtonItem alloc] initWithTitle:@"atualizar" style:UIBarButtonItemStylePlain target:self action:@selector(refreshWebView:)];
    
    self.navigationItem.rightBarButtonItem = refreshButton;//barButton;
    
    self.navigationController.navigationBar.barStyle = UIBarStyleBlackOpaque;
    //    self.navigationItem.rightBarButtonItem = refreshButton;
    
    [self doRefreshWebView:YES];
}

-(void)doRefreshWebView:(BOOL)fullRefresh {
    
    if( fullRefresh ){
        
        NSString *urlAddress = [NSString stringWithFormat:@"http://%@/ios.php/event/photos/eventId/%i", serverAddress, eventId];
        NSURL *url = [NSURL URLWithString:urlAddress];
        NSLog(@"urlAddress: %@", urlAddress);
        NSURLRequest *request = [NSURLRequest requestWithURL:url];
        
        [webView loadRequest:request];
    }else{
        
        [webView reload];   
    }
}

-(void)refreshWebView:(id)sender {
    
    [self doRefreshWebView:NO];
}

- (void)viewDidUnload
{
    [super viewDidUnload];
    // Release any retained subviews of the main view.
    // e.g. self.myOutlet = nil;
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{
    // Return YES for supported orientations
    return YES;//(interfaceOrientation == UIInterfaceOrientationPortrait);
}

- (void)connection: (NSURLConnection *)connection didReceiveResponse:(NSURLResponse *)response {
    
    NSLog(@"didReceiveResponse");
    //    [activityIndicator setHidden:YES];
}

- (void)connection: (NSURLConnection *)connection didReceiveData:(NSData *)data {
    
    NSLog(@"didReceiveData");
    
    NSString *result = [[NSString alloc] initWithData:data encoding:NSASCIIStringEncoding];
    
    
    
    NSLog(@"result: %@", result);
    
    [result release];
    
}

- (void)connectionDidFinishLoading:(NSURLConnection *)connection {
    
    NSLog(@"connectionDidFinishLoading");
    
    [self doRefreshWebView:NO];
    [activityIndicator stopAnimating];
    
    //    moveViewUp = NO;
    //    [self scrollTheView:NO];
}

- (void)webView:(UIWebView *)webView didFailLoadWithError:(NSError *)error {
    
    NSLog(@"Ocorreu um erro ao carregar a página: %@", error);
}

@end